class Pagination {
    //Set the Basic Veriables of a Pagenation-Slider
    constructor(itemCount, sliderWidth, showCount, navigation) {
        this.itemCount = itemCount;
        this.sliderWidth = sliderWidth;
        this.showCount = showCount;
        this.navigation = navigation
        this.slidertPosition = 0;
        //Get Limit, Limit in positive and negative Area
        this.maxLimit = (Math.ceil(this.itemCount / this.showCount) - 1) * this.sliderWidth;
    }
    right() {
        if (this.slidertPosition <= 0 && this.slidertPosition > -this.maxLimit) {
            this.slidertPosition -= this.sliderWidth;
            $(this.navigation).css({ "-webkit-transform": "translateX(" + this.slidertPosition + "px)", "transform": "translateX(" + this.slidertPosition + "px)" });
        }
    }
    left() {
        if (this.slidertPosition < 0) {
            this.slidertPosition += this.sliderWidth;
            $(this.navigation).css({ "-webkit-transform": "translateX(" + this.slidertPosition + "px)", "transform": "translateX(" + this.slidertPosition + "px)" });
        }
    }
}
module.exports = Pagination;