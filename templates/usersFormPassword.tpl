<!-- ------ FORM {nazwaView1} ---------------------------------------------------------------------------------------------- -->
<div id="{nazwa2}div">
	<div id="passworddiv">
    <div id="userForm">
        <div id="userFormL">
        	{nazwaView1}
        </div>
    </div>
     <div id="userForm">
        <div id="userFormR">
            <input name="{nazwa1}" type="password" class="{styl}" id="{nazwa1}"
            value="{wartosc1}" /> 
            <span class="user-error">{wymagane}</span>
		</div>
	</div>  
    </div>
    <div id="passworddiv">
    <div id="userForm">
        <div id="userFormL">
        	{nazwaView2}
        </div>
    </div>
     <div id="userForm">
        <div id="userFormR">
            <input name="{nazwa2}" type="password" class="{styl}" id="{nazwa2}" 
            onchange="getData('check{nazwa2}.php?{nazwa1}='+sendValue('{nazwa1}')+'&{nazwa2}='+sendValue('{nazwa2}'), '{nazwa2}div')"
            value="{wartosc2}" /> 
            <span class="user-error">{wymagane}</span>
            <br />
            <span class="user-error">{error}</span>
		</div>
	</div>
    </div>    
</div>