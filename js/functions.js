/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function fn_validateNumeric(evento, elemento, dec) {
    var valor=elemento.value;
    var charWich=evento.which;
    var charCode=evento.keyCode;
    if(charWich==null){
        charWich=charCode;
    }

    //48-57 are numbers; 8 is backspace, 9 is tab, 37 is left arrow, 39 is right arrow, 46 is delete, 13 is enter, 45 is dash (for negative numbers, 35 is end key, 36 is home key)
    if ( (charWich>=48 && charWich<=57) || charCode==8 || charCode==9 || charCode==37 || charCode==39 || charCode==46 || charWich==46 || charWich==13 || charWich==45 || charCode==35 || charCode==36) {

        if(dec=="n" && charWich == 46){
            return false;
        }
        else{
            if(valor.indexOf('.')!=-1 && charWich==46){
                return false;
            }
        }
        return true;
    }
    else{
        return false;
    }
}

