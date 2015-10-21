 











<form action="home#header-logo-nav" method="POST" id="room-detail" > 
    <div id="reservation-form-wrrapper" >   
    </div>
    <center>
        <div id="reservation-form-container" >   
                <div id="form-popUp-close-roomdetail" onclick="close_room_detail()" > x </div> 
                <div id="room-details-container-display" style="width:50%" > 
                    <table id="reservation-form-main-table" border="0" cellpadding="0" cellspacing="0"  width="100%" >
                        <tr> 
                            <td> 
                            </td>
                            <td> 
                                <center>
                                    <table border="1" cellspacing="0" cellpadding="5"  style=" font-size:15px; width:100%"  > 
                                        <tr> 
                                            <td style="display:none" >  
                                            </td>
                                        <tr>
                                            <td width="100" > room number :  </td><td>  </td>
                                        <tr>
                                            <td> room type: </td><td>   </td>
                                        <tr>
                                            <td>  room desc: </td><td>  </td>
                                        <tr>
                                            <td>room price per night:  </td><td>   php </td> 
                                    </table> 
                                </center>
                            </td>
                        </table> 
                </div> 
            </div>  
    </center> 
</form> 
<style type="text/css">  
    body { /*overflow: hidden;*/ }
    #room-detail { display: none;  }
    #reservation-form-wrrapper {  position: absolute; z-index: 300; opacity: 0.9;  background-color: #000;  width: 100%; /*height:3000px;  border: 1px solid #000;*/ }
    #reservation-form-container {  position: fixed; z-index: 302; /*background-color: green;*/    padding-top:5%; font-family: "arial";  /* border: 1px solid #000;*/ width: 100%; margin: auto;  }
        #form-popUp-close-roomdetail { cursor: pointer; font-size: 15px; font-family: "arial"; border: 3px solid #ccc; color: #fff; font-weight: bold; width: 20px; background-color: #415e9b; border-radius: 20px; /*padding-left: 2px; padding-right: 2px;*/ }
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

