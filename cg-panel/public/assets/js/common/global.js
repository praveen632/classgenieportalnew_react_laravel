var moment = require('moment-timezone');
/**
 * Common global class
 * It inclueds all common function
 */
module.exports = {
	//Global console log function
	fclog: function (str){
	   console.log(str);
	},
  //Return formate date in yyyy-mm-dd
  formatDate: function(strdate){
   	  var strdate = (typeof strdate == 'undefined' ? new Date() : strdate);
   	  var d = new Date(strdate),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
	    if (month.length < 2) month = '0' + month;
	    if (day.length < 2) day = '0' + day;

	    return [year, month, day].join('-');
   },
   //Retrun formate date yyyy-mm-dd hh:mm:ss
   js_yyyy_mm_dd_hh_mm_ss:function(strdate){
   	      var strdate = (typeof strdate == 'undefined' ? new Date() : strdate);
          now = new Date(strdate);
		  year = "" + now.getFullYear();
		  month = "" + (now.getMonth() + 1); if (month.length == 1) { month = "0" + month; }
		  day = "" + now.getDate(); if (day.length == 1) { day = "0" + day; }
		  hour = "" + now.getHours(); if (hour.length == 1) { hour = "0" + hour; }
		  minute = "" + now.getMinutes(); if (minute.length == 1) { minute = "0" + minute; }
		  second = "" + now.getSeconds(); if (second.length == 1) { second = "0" + second; }
		  return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
   }, 
    //Return current timestamp
   getTimeStamp: function (){return moment().tz("Asia/Calcutta").unix();}

  
}
