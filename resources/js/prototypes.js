(function(){
    Date.prototype.toYMD = Date_toYMD;
    function Date_toYMD() {
        var year, month, day;
        year = String(this.getFullYear());
        month = String(this.getMonth() + 1);
        if (month.length == 1) {
            month = "0" + month;
        }
        day = String(this.getDate());
        if (day.length == 1) {
            day = "0" + day;
        }
        return year + "-" + month + "-" + day;
    }
    
    isEmpty = function(map) {
        for(var key in map) {
          if (map.hasOwnProperty(key)) {
             return false;
          }
        }
        return true;
     }

     String.prototype.toNumber = function(){
         return parseInt(this);
     }
})();