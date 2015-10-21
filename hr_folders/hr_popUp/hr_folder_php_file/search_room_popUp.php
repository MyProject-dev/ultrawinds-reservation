 
 
 <script type="text/javascript">
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1, 
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
         
        });
        $( "#to" ).datepicker({ 
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    }); 
    $(document).ready(function ( ) { 
       
    }) 
    </script>    
    <form action="home#header-logo-nav" method="POST" id="search-form" > 
        <div id="reservation-form-wrrapper" >   
        </div>
        <center>
            <div id="reservation-form-container" >   
                    <div id="form-popUp-close"> x </div>
                    <table id="reservation-form-main-table" border="0" cellpadding="0" cellspacing="0" >
                        <tr> 
                            <td id="popUp-form-header"  > 
                                     
                                <hr>
                            </td>
                        <tr> 
                            <td id="popUp-form-body1"  > 
                                <table border="0"  cellpadding="0" cellspacing="0"  > 
                                    <tr> 
                                        <td> Check-In </td> <td> Check-Out</td> 
                                    <tr> 
                                        <td  > <input type="text" id="from" name="from" autocomplete='off' /> </td>
                                        <td> <input type="text" id="to" name="to" autocomplete='off' /> </td> 
                                </table> 
                            </td>
                        <tr> 
                            <td id="popUp-form-body2"  > 
                                 
                            </td>
                        <tr> 
                            <td id="popUp-form-footer" > 
                                <input id="popUp-form-search" type="submit" value="Seach" name="popup-search" >
                            </td>
                        <tr> 
                    </table> 
                </div>  
        </center> 
    </form>
<style type="text/css">  
    body { /*overflow: hidden;*/ }
    #search-form { display: none;  }
    #reservation-form-wrrapper {  position: absolute; z-index: 300; opacity: 0.9;  background-color: #000;  width: 100%; /*height:3000px;  border: 1px solid #000;*/ }
    #reservation-form-container {  position: fixed; z-index: 302; /*background-color: green;*/    padding-top:5%; font-family: "arial";  /* border: 1px solid #000;*/ width: 100%; margin: auto;  }
        #form-popUp-close { cursor: pointer; font-size: 15px; font-family: "arial"; border: 3px solid #ccc; color: #fff; font-weight: bold; width: 20px; background-color: #415e9b; border-radius: 20px; /*padding-left: 2px; padding-right: 2px;*/ }
        #reservation-form-main-table {position: relative;  z-index: 303;  background-color: #fff; padding: 20px; border-radius: 10px;  border: 3px solid #415e9b; box-shadow: 0px 5px 10px #000;  } 
    #popUp-form-header { padding-bottom: 20px; }
    #popUp-form-body1  { padding-bottom: 20px;  } 
        #popUp-form-body1 table  { width: 100%; }  
        #popUp-form-body1 input[type='text']  { height: 30px;  font-size: 25px;}  
    #popUp-form-body2  { padding-bottom: 20px; }
        #popUp-form-body2 select  { height: 30px; width: 279px;  font-size: 20px;}  
    #popUp-form-footer { padding-bottom: 20px; }
        #popUp-form-footer table { width: 100%; }
        #popUp-form-footer input[type='submit'] { cursor: pointer; border-radius: 10px; width: 100%; height: 50px;  background-color: #415e9b    ; color: #fff; /*cursor: pointer;*/ }
/*general style */
    *:focus {
        outline: none;
    }
</style> 