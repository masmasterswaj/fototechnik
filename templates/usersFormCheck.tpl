<!-- ------ FORM {nazwaView} ---------------------------------------------------------------------------------------------- -->
<div id="{nazwa}div">
	<div id="userForm">
        <div id="userFormL">
        	{nazwaView}
        </div>
	</div>
	<div id="userForm">
        <div id="userFormR">
            <input name="{nazwa}" type="text" class="{styl}" id="{nazwa}" 
            onchange="getData('check{nazwa}.php?{nazwa}='+sendValue('{nazwa}'), '{nazwa}div')"
            value="{wartosc}" /> 
            <span class="user-error">{wymagane}</span>
      <br />
            <span class="user-error">{error}</span>
	  </div>
	</div>   
</div>
