<!-- OKNO USUWANIA ARTYKULU {index} *************************************************************************************************************** -->
<div id="adminDelOkno" class="d{index}">
    <div id="adminDelZaw" class="d{index}">
		<form action="	" method="POST" id="formularzD{index}">
		<div id="tabsW">
		   	<ul>
				<li><a href="#tab-d011">Usuwanie artykułu</a></li>
                <li><a href="#tab-d021">Lista plików do usunięcia</a></li>
			</ul>
		  <div id="tab-d011">
					<legend>W tym miejscu możesz definitywnie<strong> usunać artykuł</strong> 
                    jak również jego połączenia z tagami, kategoriami i plikami. Po usunięciu artykułu 
                    <strong>jego pliki </strong>pozostaną na serwerze. 
                    <br />
					<br />
                    <strong>Identyfikator artykułu</strong> w bazie danych<br />
					<input name="idArtDel{index}" type="text" id="idArtDel{index}" value="{id}"  size="30" readonly="readonly" />
                    <br />
					<br />
                    <strong>Identyfikator galerii</strong> w strukturze plików i folderów<br />
					<input name="galPicId{index}" type="text" id="galPicId{index}" value="{galPicId}"  size="30" readonly="readonly" />
                    <br />
                    <br />
					<strong>Kod usunięcia</strong> artykułu<br />
					<input name="delKod{index}" type="text" id="delKod{index}" value="{delKod}"  size="30" readonly="readonly" />
                    <br />
                    <br />
					Wpisz powyższy kod usunięcia artykułu. Pamiętaj że usunięcie artykułu jest nieodwracalne.<i></i><br />
					<input  id="delKodW{index}" type="text"  name="delKodW{index}" class="formPoleText required" />
                    <br /><br />
		  			</legend>
                    <label><input type="radio" value="1" name="delFileRadio{index}" checked="checked" />
						Usuń wszystkie pliki powiązane z tym artykułem</label>
                    <br />
					<label><input type="radio" value="0" name="delFileRadio{index}" />
						Pozostaw pliki na serwerze.</label>
					<br /><br />
          	</div>
            <div id="tab-d021">
            	<legend>
            	<strong>Lista plików </strong>która zostanie usunieta z serwera raz z folderem danego atykułu <br />
					<br />
                    <textarea name="delFile" cols="80" rows="25" readonly="readonly" style="width:100%">
                   	{fileList}
                    </textarea>
            </div>
		</div>
		<span class="error">
		</span>
		<div class="buttonSubPosition">
		<input type="submit" value="Usuń" class="buttonSub" id="subDel{index}" />
		</div>
		</form>
    </div>
</div>