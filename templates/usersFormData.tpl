<!-- ------ FORM {nazwaView} ---------------------------------------------------------------------------------------------- -->
<div id="{nazwa}div">
	<div id="userForm">
        <div id="userFormL">
        {nazwaView}
        </div>
	</div>
	<div id="userForm">
        <div id="userFormR">
            <input size="30" class="{styl}" name="{nazwa}" id="dataurodzenia" />
            <button class="{styl}" id="buttondata">...</button><br />
			<script src="{pathfile}javascripts/kalendarz/view.js"></script>
            <span class="user-error">{wymagane}</span>
      		<br />
            <span class="user-error">{error}</span>
	  </div>
	</div>   
</div>
 