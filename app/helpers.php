<?php

use App\Admin;
use App\Article;
use App\Category;
use App\Customer;
use App\Delivery_address;
use App\Driver;
use App\Invoice;
use App\Mail\cancelOrderEmail;
use App\Mail\deliveredOrderEmail;
use App\Mail\forgetPasswordEmail;
use App\Mail\orderThanksEmail;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\registerEmail;
use App\Order;
use App\Photo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use function PHPSTORM_META\type;

/*Helepers Functions */
if(!function_exists('getCategories'))
{
    function getCategories()
    {
    return Category::all();
    }
}
if(!function_exists('getLastId'))
{
    function getLastId($model)
    {
        //get lastId from passed Model
        $lastId=$model::select('id')
        ->orderBy('id','desc')
        ->first();
        if(empty($lastId))
        {
            return 0;
        }
        return $lastId->id;
    }
}
if(!function_exists('storePhoto'))
{
    //store a Picture
    function storePhoto($path, $photo) 
    {
        //create a Name for the Picture with the time Function
        $photoName=time().$photo->getClientOriginalName();
        //store the Picture in the passed Path 
        $photo->move($path, $photoName);
        //return the Path complitly 
        return '/'. $path.'/'.$photoName;
    }
}
//Get the Count Of Articles, they exist in Cart
if(!function_exists('countArticlesInCart'))
{
    function countArticlesInCart()
    {   //If Cart dose'nt has any Article,it returns 0 else it returns the Count of the Articles
        if(!empty(session()->get('articles')))
        {
        return count(session()->get('articles'));
        }
        return 0;
    }
}
if(!function_exists('getCustomerInvoicess'))
{
    //Get all Invoices and Orders, they a Customer ordered yet.
    function getCustomerInvoicess($customerId)
    {
        $myOrders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->select('*','invoices.created_at as orderDate','invoices.id as invoiceId','delivery_addresses.lastName as daLastName','delivery_addresses.firstName as daFirstName','orders.id as orderId')
        ->where('customers.id','=',$customerId)
        ->orderBy('orders.created_at','desc')
        ->get();
        $orders=[];
        $order=[];
        $invoiceIds=[];
        foreach($myOrders as $myorder)
        {
            array_push($invoiceIds,$myorder->invoiceId);
        }
        $invoiceIds= array_unique($invoiceIds);
        foreach($invoiceIds as $invoiceId)
        {
            foreach($myOrders as $myorder)
            {
                if($invoiceId==$myorder->invoiceId)
                {
                    array_push($order,$myorder);
                }
            }
            array_push($orders,$order);
            $order=[];
        }
        $myOrders=null;
        return $orders;
    }
 
}
if(!function_exists('checkEmail'))
{
    function checkEmail($email)
    {
        $customer=Customer::where('email',$email)->first();
        $driver=Driver::where('email',$email)->first();
        $admin=Admin::where('email',$email)->first();
        if(empty($customer) && empty($driver) && empty($admin))
        {
            $admin=$customer=$driver=$email=null;
            return true;
        }
        $admin=$customer=$driver=$email=null;
        return false;
        
    }
}
//Gruping Orders As InvoiceId.
if(!function_exists('ordersStruktur'))
{
    //Important!! $myOrders Array musst have the attribute invoiceId
    function ordersStruktur($myOrders)
    {
        //Multi-Array Orders Struktur
        $orders=[];
        $order=[];
        $invoiceIds=[];
        foreach($myOrders as $myorder) 
        {
            array_push($invoiceIds,$myorder->invoiceId);
        }
        $invoiceIds= array_unique($invoiceIds);
        foreach($invoiceIds as $invoiceId)
        {
            foreach($myOrders as $myorder)
            {
                if($invoiceId==$myorder->invoiceId)
                {
                    array_push($order,$myorder);
                }
            } 
            array_push($orders,$order);
            $order=[];
        }
        $myOrders=null;
        return $orders;
    }
}
//Get Count of Articles, which the Driver should deliver
if(!function_exists('toDeliverCount'))
{
    function toDeliverCount($orderId)
    {
        $order=Order::getOrder($orderId);
        //toDeliverCount 'how much should the Driver deliver'
        $toDeliverCount=$order->demagedArticle+$order->demagedAcceptCount+$order->noAcceptCount;
        if($toDeliverCount>0)
        {
            $toDeliverCount-=$order->cancelCount;
        }
        else{
            $toDeliverCount=$order->articleCount-$order->cancelCount;
        }
        return $toDeliverCount;
    }
}
/*registerController*/
//Return all Values of Inputs in the Registerform
if(!function_exists('getRegisterData'))
{
    //get all necessary Data from Rrgister-Form
    function getRegisterData($request)
    {
        return [
            "lastName"=>$request->lastName,
            "firstName"=>$request->firstName,
            "email"=>$request->email,
            "password"=>$request->password,
            'city'=>$request->city,
            "plz"=>$request->plz,
            "street"=>$request->street,
            "hausNr"=>$request->hausNr
            ];
    }
}
//Set the Rules of Inputs in Register-Form
if(!function_exists('getRegisterRules'))
{   
    function getRegisterRules()
    {
        return[
            "lastName"=>'required|regex:/^[\pL\s\-]+$/u',
            "firstName"=>'required|regex:/^[\pL\s\-]+$/u',
            'email'=>'required|email',
            'password' =>'required|min:7',
            'city'=>'required|alpha',
            "plz"=>'required|numeric',
            "street"=>'required|alpha',
            "hausNr"=>'required|numeric',
        ];
    }
}
//Set the Messages of all Errors in the Register-Form
if(!function_exists('getRegisterMessage'))
{
    function getRegisterMessage()
    {
        return[
            "lastName.required"=>'Name ist erforderlich',
            "lastName.regex"=>'Name kann nur aus Buchstabe bestehen',
            "firstName.required"=>'Vorname ist erforderlich',
            "firstName.regex"=>'Vorname kann nur aus Buchstabe bestehen',
            'email.required'=>'E-Mail ist erforderlich',
            'email.email'=>'E-Mail muss eine gültige Mailadresse sein',
            'password.required' =>'Passwort ist erforderlich',
            'password.min' =>'Passwort muss mindestens 7 Zeichen lang sein',
            "city.required"=>'Stadt ist erforderlich',
            "city.alpha"=>'Stadt kann nur aus Buchstabe bestehen',
            "plz.required"=>'PLZ ist erforderlich',
            "plz.numeric"=>'PLZ kann nur aus Zahlen bestehen',
            "street.required"=>'Straße ist erforderlich',
            "street.alpha"=>'Straße kann nur aus Buchstabe bestehen',
            "hausNr.required"=>'HausNr ist erforderlich',
            "hausNr.numeric"=>'HausNr kann nur aus Zahlen bestehen',
        ];
        
    }
}
//Register-Validation
if(!function_exists('validationRegister'))
{
    function validationRegister($request)
    {
       return validator::make(getRegisterData($request),getRegisterRules(),getRegisterMessage());
    }
}

//Customer will update his Data
if(!function_exists('getUpdateData'))
{
    //get all necessary Data from Update-Form
    function getUpdateData($request)
    {
        return [
            "lastName"=>$request->lastName,
            "firstName"=>$request->firstName,
            'city'=>$request->city,
            "plz"=>$request->plz,
            "street"=>$request->street,
            "hausNr"=>$request->hausNr
            ];
    }
}
//Set the Rules of Inputs in Update-Form
if(!function_exists('getUpdateRules'))
{   
    function getUpdateRules()
    {
        return[
            "lastName"=>'required|regex:/^[\pL\s\-]+$/u',
            "firstName"=>'required|regex:/^[\pL\s\-]+$/u',
            'city'=>'required|alpha',
            "plz"=>'required|numeric',
            "street"=>'required|alpha',
            "hausNr"=>'required|numeric',
        ];
    }
}
//Set the Messages of all Errors in the Update-Form
if(!function_exists('getUpdateMessage'))
{
    function getUpdateMessage()
    {
        return[
            "lastName.required"=>'Name ist erforderlich',
            "lastName.regex"=>'Name kann nur aus Buchstabe bestehen',
            "firstName.required"=>'Vorname ist erforderlich',
            "firstName.regex"=>'Vorname kann nur aus Buchstabe bestehen',
            "city.required"=>'Stadt ist erforderlich',
            "city.alpha"=>'Stadt kann nur aus Buchstabe bestehen',
            "plz.required"=>'PLZ ist erforderlich',
            "plz.numeric"=>'PLZ kann nur aus Zahlen bestehen',
            "street.required"=>'Straße ist erforderlich',
            "street.alpha"=>'Straße kann nur aus Buchstabe bestehen',
            "hausNr.required"=>'HausNr ist erforderlich',
            "hausNr.numeric"=>'HausNr kann nur aus Zahlen bestehen',
        ];
        
    }
}

//Update-Validation
if(!function_exists('validationUpdate'))
{
    function validationUpdate($request)
    {
       return validator::make(getUpdateData($request),getUpdateRules(),getUpdateMessage());
    }
}





//check if the email exists
if(!function_exists('emailExistiert'))
{
    function emailExistiert($email)
    {
        if(!empty(Customer::where('email',$email)->first()->email))
        {
            return true;
        }
    }
}

//Send E-mail
if(!function_exists('sendRegisterEmail'))
{
    function sendRegisterEmail($request)
    {
        //Save the CustomersData in a Session
        $request->session()->put('customer', getRegisterData($request));
        Mail::to($request->email)->send(new registerEmail());
    }
}
//create Customer
if(!function_exists('createCustomer'))
{
    function createCustomer($customer)
    {
        if(emailExistiert($customer['email']))
        {
            return view('error.error',['sts'=>'Diese e-mail-Adresse ist schon vorhanden']);
        }
        Customer::create([
            'lastName'=>$customer['lastName'],
            'firstName'=>$customer['firstName'],
            'email'=>$customer['email'],
            'password'=>Hash::make($customer['password']),
        ]);
        Delivery_address::create([
            'lastName'=>$customer['lastName'],
            'firstName'=>$customer['firstName'],
            'city'=>$customer['city'],
            'plz'=>$customer['plz'],
            'street'=>$customer['street'],
            'hausNr'=>$customer['hausNr'],
            'customer_id'=>getLastId(Customer::class)
        ]);
    }
}

/*loginController */
if(!function_exists('loginCheck'))
{
function loginCheck($request)
    {
        //Check Customers
        if(Auth::guard('customer')->attempt(["email"=>$request->email,"password"=>$request->password])){
            return 'customer';
        }
        //check Drivers
        elseif(Auth::guard('driver')->attempt(["email"=>$request->email,"password"=>$request->password]))
        {
            return 'driver';
        }
        //Check Admins
        elseif(Auth::guard('admin')->attempt(["email"=>$request->email,"password"=>$request->password]))
        {
            return 'admin';
        }
        else{
            return false;
        }
    }
}

/*forgetPasswordController */
if(!function_exists('getForgetPasswordMessages'))
{
    function getForgetPasswordMessages()
    {
        return[
            'passwort.required'=>'Passwort ist erforderlich',
            'passwort.min'=>'Passwort muss mindestens 7 Zeichen lang sein',
        ];
    }
}
if(!function_exists('forgetPasswordCheck'))
{
    function forgetPasswordCheck($password)
    {
        return Validator::make(['passwort'=>$password], ['passwort'=>'required|min:7'], getForgetPasswordMessages());
    }
}
if(!function_exists('forgetPasswordEmailSend'))
{
    function forgetPasswordEmailSend($request)
    {
        session()->put('email',$request->email);
        session()->put('password',$request->password);
        Mail::to($request->email)->send(new forgetPasswordEmail());
    }
}
if(!function_exists('resetPassword'))
{
    function resetPassword()
    {
        if(!empty(session()->get('email')) && !empty(session()->get('password')))
        {
            Customer::where('email',session()->get('email'))
            ->update(['password'=>Hash::make(session()->get('password'))
            ]);
            Auth::guard('customer')->attempt(['email'=>session()->get('email'), 'password'=>session()->get('password')]);
            session()->forget('email');
            session()->forget('password');
            return true;
        }
        return view('error.error',['sts'=>'Fehlermeldung']);
    }
}

/*categoryController*/
if(!function_exists('categoryAddValidation'))
{
    //Categoy Add Validation
    function categoryAddValidation($request)
    {
        return Validator::make(
            [
                'name'=>$request->name,
                'logo'=>$request->logo,
                'foto'=>$request->foto
            ],
            [   
                'name'=>'required',
                'logo'=>'required',
                'foto'=>'required'
            ],
            [
                'name.required'=>'Die Name der Kategore ist erforderlich',
                'logo.required'=>'Das Logo ist erforderlich',
                'foto.required'=>'Das Foto ist erforderlich'
            ]);
    }
}
if(!function_exists('createNewCategory'))
{
    //Create new Category
    function createNewCategory($request)
    {
        //Store the Category-Picture in this Path
        $photoPath=storePhoto('photos/categories/'.$request->name, $request->foto);
        //create Category
        Category::create([
            'categoryName'=>$request->name,
            'logo'=>$request->logo,
            'photo'=>$photoPath
        ]);
    }
}
if(!function_exists('categoryExists'))
{
    //Check if Category exists
    function categoryExists($categoryName)
    {
      if(!empty(Category::where('categoryName',$categoryName)->first()))
      {
          return true;
      }
    }
}
if(!function_exists('getCategoryPhotoPath'))
{
    function getCategoryPhotoPath($categoryId,$photo,$categoryName)
    {
        //get Path of Photo from DB
        $photoPath=Category::where('id',$categoryId)->first()->photo;
        //Admin did NOT chose a new Photo
        if(empty($photo))
        {
            return $photoPath;
        }
        //Admin choosed a new Photo, therefore old Photo must be deleted from public
        else{
            unlink(public_path($photoPath));
            $photoPath=storePhoto('photos/categories/'.$categoryName, $photo);
            return $photoPath;
        }
    }
}

/*articleController*/
if(!function_exists('articleStoreValidation'))
{
    function articleStoreValidation($request)
    {
        return Validator::make(getArticleData($request), getArticleRules(), getArticleMessages());
    }
}
if(!function_exists('getArticleData'))
{
    function getArticleData($request)
    {
        return[
            'name'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'categoryname'=>$request->categoryname,
            'photo'=>$request->photo,
            'photos'=>$request->photos,
        ];
    }
}
if(!function_exists('getArticleRules'))
{
    function getArticleRules()
    {
        return[
            'name'=>'required',
            'price'=>'required|numeric',
            'description'=>'required',
            'categoryname'=>'required',
            'photo'=>'required',
            'photos'=>'required'
        ];
    }
}
if(!function_exists('getArticleMessages'))
{
    function getArticleMessages() 
    {
        return[
            'name.required'=>'Name des Artikels ist erforderlich',
            'price.required'=>'Preis des Artikels ist erforderlich',
            'price.numeric'=>'Der Preis soll nur aus Zahlen bestehen',
            'description.required'=>'Beschreibung des Artikels ist erforderlich',
            'categoryname.required'=>'Wählen Sie bitte die Category des Artikels aus',
            'photo.required'=>'Wählen Sie bitte das Hauptfoto des Artikels aus',
            'photos.required'=>'Wählen Sie bitte die Fotos des Artikels aus'
        ];
    }
}
if(!function_exists('storeArticle'))
{
    //Store the Article
    function storeArticle($request)
        {
            $articleId=getLastId(Article::class)+1;
            Article::create([
                'articleName'=>$request->name,
                'price'=>$request->price,
                'description'=>$request->description,
                'mainPhoto'=>storePhoto('photos/articles/'.$articleId.'/mainPhoto', $request->photo),
                //Name of Category is UNIQE
                'category_id'=>Category::where("categoryName",$request->categoryname)->first()->id,
            ]);
        }
}
if(!function_exists('storeArticlePhotos'))
{
    //Store all Photos of the Article
    function storeArticlePhotos($photos, $articleId)
    {
        foreach($photos as $photo)
        {
            Photo::create([
                'path'=>storePhoto('photos/articles/'.$articleId.'/Pictures',$photo),
                'article_id'=>$articleId
            ]);
        }
    }
}
if(!function_exists('articleAtributesFilter'))
{
    //With Updating of a Article get JUST Values of Inputs, they are DONT empty
    function articleAtributesFilter($request)
    {
        $articleAtributes=[];
        $articleAtributes['articleName']=$request->name;
        $articleAtributes['price']=$request->price;
        $articleAtributes['description']=$request->description;
        //When Changing the Category, get Category_id from categoryName 'categoryName is UNIQE'
        if(!(empty($request->categoryname)))
        {
            $articleAtributes['category_id']=Category::where("categoryName",$request->categoryname)->first()->id;
        }
        //When Changing the MainPhoto remove from Public the 'OldMainPhoto' and stor in Public the 'NewMainPhoto'
        if(!empty($request->newMainPhoto))
        {
            unlink(public_path($request->oldMainPhoto));
            $articleAtributes['mainPhoto']=storePhoto('photos/articles/'.$request->articleId.'/mainPhoto', $request->newMainPhoto);
        }
        //If there are more Photos to add
        if(!empty($request->photos))
        {
            storeArticlePhotos($request->photos, $request->articleId);
        }
        //Filter the articleAtributes Array and return JUST Attributes, they are DONT empty
        return array_filter($articleAtributes);
    }
}
if(!function_exists('articlePhotosDelete'))
{
    //Delete all Photos, they were choosed during a Checkbox
    function articlePhotosDelete($checkboxes, $articleId)
    {
        //Checking if they are Photos to delete 
        if(!empty($checkboxes))
        {
            //Get all Paths of choosed Photos
            foreach($checkboxes as $checkbox => $path)
            {
                //Remove the Path from Public
                unlink(public_path($path));
                //Delete the Photo from DB
                Photo::where('article_id',$articleId)
                ->where('path', $path)
                ->delete();
            }
        }
    }
}
/*orderController*/
if(!function_exists('createOrder'))
{
    function createOrder()
    {   //Get all Articles from session 'from Cart'
        $articles=session()->get('articles');
        //Get the last Invoice Id
        $invoiceId=getLastId(Invoice::class);
        //Create the Orders
        foreach($articles as $article)
        {
            Order::create([
                'article_id'=>(int)$article['id'],
                'invoice_id'=>$invoiceId,
                'articleCount'=>(int)$article['articleCount'],
                'toDileverCount'=>(int)$article['articleCount'],
                'orderDelivered'=>'no'
            ]);
        }
    }
}
//Send to Customer a Thanks-Email for Order
if(!function_exists('orderIndexTitle'))
{
    function  sendTanksOrderEmail($orders)
    {
        //Mail::to($emailCustomer)->send(new orderThanksEmail());
        Mail::to(Auth::guard('customer')->user()->email)->send(new orderThanksEmail($orders));
    }
}

//Get the Title in Order-Index
if(!function_exists('orderIndexTitle'))
{
    function orderIndexTitle($date)
    {   
        //After 3 Days
        if($date=='After3Days')
        {
            return 'In 3 Tagen';
        }
        //After Tomorrow
        elseif($date=='AfterTomorrow')
        {
            return 'Übermorgen';
        }
        //Tomorrow
        elseif($date=='Tomorrow')
        {
            return 'Morgen';
        }
        //Today
        else
        {
            return 'Heute';
        }

    }
}
//Get all Invoices and Orders, they the Customers ordered yet.
if(!function_exists('getAllOrders'))
{
    function getAllOrders($date)
    {
        $today=null;
        $filter=null;
        //Get all Invoices and Orders, they the Customers ordered tody
        if($date=='After3Days')
        {
            $today=Carbon::now();
            $filter= '=';
        }
        //Get all Invoices and Orders, they the Customers  ordered before 1 Day
        elseif($date=='AfterTomorrow')
        {
            $today=Carbon::now();
            $today->subDay(1);
            $filter= '=';
        }
        //Get all Invoices and Orders, they the Customers  ordered before 2 Days
        elseif($date=='Tomorrow')
        {
            $today=Carbon::now();
            $today->subDays(2);
            $filter= '=';
        }
        //Get all Invoices and Orders, they the Customers ordered before 3 Days
        elseif($date=='Today'){
            $today=Carbon::now();
            $today->subDays(3);
            $filter='=';
        }
        //Get all Invoices and Orders, they were NOT delivered and Not canceled
        else{
            $today=Carbon::now();
            $today->subDays(4);
            $filter='<=';
        }
        //Get Data join Tables "customers, delivery_addresses, orders, articles" filter with "requested Order Index Title"(Today, Tomowrrow, After Tomorrow, After3Days, Otherwise)
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->select('*','invoices.created_at as orderDate','invoices.id as invoiceId','orders.id as orderId','delivery_addresses.lastName as daLastName','delivery_addresses.firstName as daFirstName')
        ->whereDate('invoices.created_at', $filter ,$today->format('Y-m-d'))
        ->get();
        //Multi-Array Orders Struktur
        return ordersStruktur($orders);
    }
}
//Check if exists any Order still in the Invoice (After Deleting the Order )
if(!function_exists('checkInvoice'))
{
    function checkInvoice($InviceId)
    {
      return  Order::where('invoice_id',$InviceId)->get();
    }
}
if(!function_exists('cancelOrder'))
{
    function cancelOrder($orderId, $reasonCancel, $adminReaktion ,$cancelCount)
    {
        $person=null;
        if(Auth::guard('admin')->check())
        {
            $person='admin';
        }else{
            $person='driver';
        }
        Order::where('id',$orderId)
        ->update([
            'cancelDecision'=>$person,
            'reasonCancel'=>$reasonCancel,
            'adminReaktion'=>$adminReaktion,
            'cancelCount'=>$cancelCount
        ]);
        $person=$orderId=$reasonCancel=$adminReaktion=null;
    }
}

//Send to Customer an Email, that was canceld the Order
if(!function_exists('cancelOrderEmail'))
{
    function cancelOrderEmail($email,$order,$reasionCancel,$adminReaktion)
    {
        Mail::to($email)->send(new cancelOrderEmail($order,$reasionCancel,$adminReaktion));
        $email=$order=$reasionCancel=$adminReaktion=null;
    }
}
//Send to Customer an Email, that was dilevered the Order
if(!function_exists('deliveredOrderEmail'))
{
    function  dileveredOrderEmail($email, $order)
    {
        Mail::to($email)->send(new deliveredOrderEmail($order));
    }
}
if(!function_exists('ordersToDrivers'))
{
    function ordersToDrivers()
    {   //Get Orders, they should be delivered tody 
        $today=Carbon::now();
        $today->subDays(3);
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id') 
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->leftJoin('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->select('*','invoices.id as invoiceId')
       //->whereDate('orders.created_at', '=',$today->format('Y-m-d'))
        ->where('orders.cancelDecision','=',null)
        ->where('orders.orderDelivered','=','no')
        ->get();
         return ordersStruktur($orders);
    }
}
if(!function_exists('returnOrders'))
{
    function returnOrders()
    {
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->leftJoin('drivers', 'invoices.driver_id', '=', 'drivers.id')
        ->select('*','invoices.id as invoiceId', 'orders.id as orderId', 'orders.created_at as orderDate','delivery_addresses.lastName as daLastName','delivery_addresses.firstName as daFirstName')
        ->Where('demagedArticle','>',0)
        ->orWhere('noAcceptCount','>',0)
        ->orWhere('demagedAcceptCount','>',0)
        ->orWhere('cancelCount','>',0)
        ->where(function ($query) {
            $query->where('orderDelivered','yes');
        })
        ->get();
        return ordersStruktur($orders);
    }
}

/*driverController */
if(!function_exists('driverValidation'))
{
    function  driverValidation($request)
    {
      return  Validator::make([
            'driverFirstName'=>$request->driverFirstName,
            'driverLastName'=>$request->driverLastName,
            'email'=>$request->email,
            'password'=>$request->password,
            'phone'=>$request->phone,
        ],
        [
            "driverFirstName"=>'required|regex:/^[\pL\s\-]+$/u',
            "driverLastName"=>'required|regex:/^[\pL\s\-]+$/u',
            'email'=>'required|email',
            'password' =>'required|min:7',
            'phone'=>'required',
        ],
        [
            "driverFirstName.required"=>'Vorname ist erforderlich',
            "driverFirstName.regex"=>'Vorname kann nur aus Buchstabe bestehen',
            "driverLastName.required"=>'Name ist erforderlich',
            "driverLastName.regex"=>'Name kann nur aus Buchstabe bestehen',
            'email.required'=>'E-Mail ist erforderlich',
            'email.email'=>'E-Mail muss eine gültige Mailadresse sein',
            'password.required' =>'Passwort ist erforderlich',
            'password.min' =>'Passwort muss mindestens 7 Zeichen lang sein',
            'phone.required'=>'Handynummer ist erforderlich',
        ]);
    }
}
if(!function_exists('getDriverData'))
{
    function  getDriverData($request)
    {
        $driver=[];
        if(!empty($request->driverLastName))
        {
            $driver['driverLastName']=$request->driverLastName; 
        }
        if(!empty($request->driverFirstName))
        {
            $driver['driverFirstName']=$request->driverFirstName;
        }
        if(!empty($request->driverLastName))
        {
            $driver['driverLastName']=$request->driverLastName;
        }
        if(!empty($request->phone))
        {
            $driver['phone']=$request->phone;
        }
        if(!empty($request->password))
        {
            $driver['password']=Hash::make($request->password);
        }
        return $driver;
    }
}
//Get all Orders, they should be delivered from a Driver
if(!function_exists('driverIndex'))
{
    function driverIndex()
    {
        $orders=DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->leftJoin('drivers','invoices.driver_id','=','drivers.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->select('*','invoices.id as invoiceId','orders.id as orderId')
        ->where('drivers.id', Auth::guard('driver')->user()->id)
        ->where('orderDelivered','no')
        ->get();
        return ordersStruktur($orders);
    }
}
//Get Orders, they the Driver will deliver now
if(!function_exists('deliver'))
{
    function deliver($invoiceId)
    {
        return DB::table('customers')
        ->join('delivery_addresses','delivery_addresses.customer_id','=','customers.id')
        ->join('invoices','invoices.delivery_address_id','=','delivery_addresses.id')
        ->leftJoin('drivers','invoices.driver_id','=','drivers.id')
        ->join('orders','orders.invoice_id','=','invoices.id')
        ->join('articles','articles.id','=','orders.article_id')
        ->select('*','invoices.id as invoiceId','customers.email as customerEmail','delivery_addresses.lastName as daLastName','delivery_addresses.firstName as daFirstName')
        ->where('invoices.id',$invoiceId)
        ->where('orders.orderDelivered','!=','yes')
        ->get();
    }
}
if(!function_exists('deliverConfirmValidation'))
{
    function  deliverConfirmValidation($name, $street, $hausNr)
    {
      return Validator::make([
           'name'=>$name,
           'street'=>$street,
           'hausNr'=>$hausNr
       ],
       [
           'name'=> 'required|regex:/^[\pL\s\-]+$/u',
           'street'=>'required|regex:/^[\pL\s\-]+$/u',
           'hausNr'=>'required|numeric'
       ],
       [
        "name.required"=>'Name ist erforderlich',
        "name.regex"=>'Name kann nur aus Buchstabe bestehen',
        "street.required"=>'Straße ist erforderlich',
        "street.regex"=>'Straße kann nur aus Buchstabe bestehen',
        "hausNr.required"=>'HausNr ist erforderlich',
        "hausNr.numeric"=>'HausNr kann nur aus Zahlen bestehen',
       ]);
    }
}
if(!function_exists('driverConfirmDeliver'))
{
    function driverConfirmDeliver($request)
    {
        if($request->articlePlace=="customer")
        {
            $Place='Persönlich wurde die Bestellung bei der Kunde zugestellt';
        }
        else
        {
            $Place='Bei dem Nachbar wurde die Bestellung zugestellt. Name:'.$request->nameOfNeighbor.' Straße:'.$request->streetOfNeighbor.' HausNr:'.$request->hausNrOfNeighbor;
        }
        Order::where('invoice_id',$request->invoiceId)
        ->update([
        'orderDelivered'=>'yes',
        'articlePlace'=>$Place
        ]);
    } 
}

/*myOrdersController*/
if(!function_exists('getCustomerOrder'))
{
    function getCustomerOrder($orderId)
    {
        return DB::table('orders')
        ->join('articles','articles.id','=','orders.article_id')
        ->where('orders.id',$orderId)
        ->select('*','orders.id as orderId')
        ->first();
    }
}

?>