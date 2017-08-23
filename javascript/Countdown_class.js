/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 *  Countdown Timer 
 *  By: Abiodun Solomon Azeez
 *  facebook.com/habbeboy
 *  @habbeboy
 *  
 */


   var Countdown = (function(obj) {
      
	   //console.log(n);
       this._timer = obj;
       this._h  = obj.hours;
       this._m = obj.minutes;
       this._s = obj.seconds;
       this._url = obj.ajax;
       this._u  = obj.user;

       
       this.countdown = function(objects) {
      
	  var _time, _split, _add = 0, _u;
	  
	  if(typeof(objects) !== undefined || objects !== '') {
		  
                  /*
                   *  if objects.time key exists
                   */
		  
		  if(objects.time) {
			  
			   _u = 'timer_';
			   _t = check({url: 'public/ajax_time.php'});
			   _time = '';
			   if (_t === 'NaN:NaN:NaN') {
				   
				  _time = objects.time;
			   } else {
				  _time = _t;
			   }
			  _split = _time.split(':');

			  _split.forEach(function(a) {
			     //_add = _add + parseInt(a);
                             if(parseInt(_split[0]) > 0) {
                                 
                                 _add = 60 + parseInt(_split[1]);
                                 
                             } else {
                                 
                                 _add = parseInt(_split[1]);
                                 //_add += parseInt(_split[2]);
                             }
			  }); 
			  
                          _dm = 60 * _add;     
               
			return _dm;
		
		  }
                  
                 
                  
	  } else {
		  
		  throw new Error('countdown requires at least one object parameter');
	  }
  };
  
   
    this.async();
   });
   
  Countdown.prototype = { 
     
     async : function() {
    	 var _a, _h = '', _m = '', _s = '', _uri = this._url, _u = this._u;
    	
    	 _a = this.countdown( this._timer );
    	
        /**
         * @ check if hours is declared!
         */
               if (this._h ) {
                   
                   _h = this._h;
                   
               } else {
                   
                   _h = '';
               } 
               
               if (this._m ) {
                   
                   _m = this._m;
                   
               } else {
                   _m = '';
               }
               
                if (this._s ) {
                   
                   _s = this._s;  
               } else {
                  _s = '';    
               }
               
                INTERVAL = 1000;  
           var cd =  setInterval(function() {
               var hours, minutes, seconds, save_list;  
               hours   = parseInt(_a/ 60 / 60);
               minutes = parseInt(_a/60 % 60);
               seconds = parseInt(_a % 60);
               _hs = ((hours < 10) ? '0' + hours : hours ); 
               _mm = ((minutes < 10) ? '0'+minutes : minutes ); 
               _ss = ((seconds < 10 ) ? '0'+seconds : seconds );
              
              
               var _hrs = document.getElementById(_h),//.value = _hs;
                   _mms = document.getElementById(_m),//.value = _mm;
                   _sss = document.getElementById(_s);//.value = _ss;
           
                   _hrs.value = _hs;_mms.value = _mm; _sss.value = _ss;
               
               if ( _hrs.value === '00' && _mms.value === '00'  && _sss.value === '00') 
               {
                 // window.location.reload();
                 
                  if (_uri) {

                     window.location = _uri + '?action=end';

                  } else {

                    clearInterval(cd);
                     window.alert('oOps Time Up !');
                     return false;
                  }
                 
               } else {
            	   
            	   if (parseInt(_hrs.value) === 0 && parseInt(_mms.value) < 10 ) 
            	   {
            		  _hrs.style.color = 'red';
            		  _mms.style.color = 'red';
            		  _sss.style.color = 'red';
            	   }
            	   
            	   if (parseInt(_hrs.value) === 0 && parseInt(_mms.value) === 9
            		 && parseInt(_sss.value) == 55) 
            	   {
            		   var d = document.querySelector('#notify');
            		   d.className = 'animated wobble';
            		   d.style.display = 'block';
            	   } else if (parseInt(_hrs.value) === 0 && parseInt(_mms.value) === 9 
                  		 && parseInt(_sss.value) == 50) 
            	   {
            		   var d = document.querySelector('#notify');
            		   d.className = 'animated flipOutX';
            		   //d.style.display = 'none';
            	   }   
                  _a --; 
                  //var stores = _hrs.value + ':' + _mms.value + ':'+ _sss.value;
                  //var key = 'timer_';
                 //sessionStorage.setItem( key , stores );
                 save({ url: _uri, _hh: _hrs.value, _mm: _mms.value, _ss: _sss.value});
               }
               
            }, INTERVAL );
    
     },

    
  };
 
  
 var save = function(_params) { 

        var data = '?action=save&h='+_params._hh +'&m='+_params._mm+'&s='+_params._ss;

        if (_params) {

           var url = _params.url + data,
               method = 'GET',
               xhr = new XMLHttpRequest();

           xhr.open( method, url, false);
           xhr.send(null);
           var resp = xhr.responseText;

           //return console.log(resp);
        }
     };

var check = function(obj) {

     var data = '?action=check';

           var url = obj.url + data,
               method = 'GET',
               xhr = new XMLHttpRequest();

           xhr.open( method, url, false);
           xhr.send(null);
           var resp = xhr.responseText;

           return resp;
};

