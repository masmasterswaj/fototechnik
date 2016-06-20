<!-- ------ FORM {nazwaView} ---------------------------------------------------------------------------------------------- -->
<div id="{nazwa}div">
	<div id="userForm">
        <div id="userFormL">
        	{nazwaView}
        </div>
	</div>
	<div id="userForm">
        <div id="userFormR">
        	<select name="{nazwa}" class="{styl}">
        	{lista}
   	      	</select>
            <span class="user-error">{wymagane}</span>
      		<br />
            <span class="user-error">{error}</span>
	  </div>
	</div>   
</div>
