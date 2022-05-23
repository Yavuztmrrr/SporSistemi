var $cc = {}
$cc.expiry = function(e){
  if (e.key != 'Backspace'){
    var number = String(this.value);

    //remove all non-number character from the value
    var cleanNumber = '';
    for (var i = 0; i<number.length; i++){
      if (i == 1 && number.charAt(i) == '/'){
        cleanNumber = 0 + number.charAt(0);
      }
      if (/^[0-9]+$/.test(number.charAt(i))){
        cleanNumber += number.charAt(i);
      }
    }

    var formattedMonth = ''
    for (var i = 0; i<cleanNumber.length; i++){
      if (/^[0-9]+$/.test(cleanNumber.charAt(i))){
      
        if (i == 0 && cleanNumber.charAt(i) > 1){
          formattedMonth += 0;
          formattedMonth += cleanNumber.charAt(i);
          formattedMonth += '/';
        }
        
        else if (i == 1){
          formattedMonth += cleanNumber.charAt(i);
          formattedMonth += '/';
        }
        //force a 4 digit year
       else{
          formattedMonth += cleanNumber.charAt(i);
        }

      }
    }
    this.value = formattedMonth;
  }
}
