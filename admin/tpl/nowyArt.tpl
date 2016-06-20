<!-- OKNO UTWORZENIA NOWEGO ARTYKUŁU ************************************************************************************************************************* -->
<div id="adminWriteOkno">
    <div id="adminWriteZaw">
		<form action="	" method="POST" id="formularzW">
		<div id="tabsW">
		   <ul>
				<li><a href="#tab-w011">Tytyły i autorzy</a></li>
				<li><a href="#tab-w012">Tekst aktualności</a></li>
				<li><a href="#tab-w013">Tekst artykułu</a></li>
				<li><a href="#tab-w014">Tagi</a></li>
				<li><a href="#tab-w015">Kategorie</a></li>
				<li><a href="#tab-w016">Opcje</a></li>
			</ul>
			<div id="tab-w011">
					<legend>Na początku należy dodać tytuł artykułu lub aktualności. W zależności czy będziemy wypełniać tylko aktualność, 
					czy jednak dołączymy do tego jeszcze artykuł</legend>
					<br />
					Wpisz <b>tytuł aktualności</b> dodawanej do fotobloga <i>( pole wymagane )</i><br />
					<input name="tytulAktW" type="text"  size="60" minlength="1" class="formPoleText required" id="tytulAktW" /><br />
					Podaj<strong> imię i nazwisko</strong> lub <strong>nica</strong> osoby która jest autorem zdjęć. Jeżeli nie ma konkretnej osoby pozostaw wpis <strong>BRAK</strong><br />
					<input name="tytulArtW" type="text" class="formPoleText required" id="tytulArtW" value="BRAK"  size="60" minlength="1"/><br />
					Podaj <b>datę publikacji aktualności</b>. Aktualności są sortowane według daty <i>( pole wymagane )</i><br />
					<input  id="datepickerW" type="text"  name="dataAktW" class="formPoleText required" /><br />
					Podaj <b>autora</b> tego tej publikacji. Może być to również autor zdjęć. Jeśli jest więcej autorów oddziel ich przecinkiem <i>( pole wymagane )</i><br />
					<input name="autorW" type="text"  size="40" minlength="1" class="formPoleText required" id="autorW" /><br />
			</div>
			<div id="tab-w012">
					<legend>Napisz <b>treść aktualności</b>. Pamiętaj, że w tym miejscu powinna znajdować się, krótka informacja. Dla dłuższego artykułu masz miejsce 
					w następnym kroku - Tekst artykułu.</legend> 
					<textarea name="textAktW" style="width:100%" rows="30" id="textAktW" class="required"></textarea>
			</div>
			<div id="tab-w013">
					<legend>Napisz <b>treść artykułu przypisanego do tej aktualności</b>. Jeżeli w pierwszym oknie nie podałeś tutułu aktualności i 
					pozostawiłeś "Brak" to treść artykułu i tak nie zostanie dodana. Jeśli artykuł ma być dodany to wymagany jest <b>tytuł artykułu</b> 
					w pierwszym oknie. Może byc taki sam jak tytuł aktualności.</legend>
					<textarea name="textArtW" style="width:100%" rows="30" id="textArtW" class="required"></textarea>
			</div>
			<div id="tab-w014">
					<legend>W tym miejscu możesz przypisać tagi dla danej aktualności.</legend>
					
					Klikając <b>wybierz tagi</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
					dodawania nowych tagów. Musisz wybrać choć <b>jeden tag</b> dla tego artykułu lub aktualności.( pole wymagane )</i><br />
		 
					<div id="adminWriteTag">
					BLAD ZALADOWANIA TAGOW Z BAZY DANYCH
					</div>
					
					<input name="tagAktW" id="tagAktW" type="text"  size="90" minlength="1" class="formPoleText required" /><br />
					
			</div>
			<div id="tab-w015">
					<legend>W tym miejscu możesz przypisać artykuł i aktualność do odpowiedniej kategorii.</legend>
					Klikając <b>wybierz kategorię</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
					dodawania nowych kategorii. Musisz wybrać choć <b>jedną kategorię</b> dla tego artykułu lub aktualności.( pole wymagane )</i><br />
		 
					<div id="adminWriteKat">
					BLAD ZALADOWANIA KATEGORII Z BAZY DANYCH
					</div>                     
					<input name="katAktW" id="katAktW" type="text"  size="90" minlength="1" class="formPoleText required" /><br />
					
			</div>
			<div id="tab-w016">
					<legend>Ustawienia dla aktualności i artykułów.</legend>
					Zaznaczając odpowiednie pola możesz zdecydować czy dodawany artykuł będzie częścią fotobloga wyświetlaną w głównym oknie
					czy jedna pozostanie samodzielnym artykułem do ktorego przypiszesz odpowienią kategorię wybraną w poprzednim oknie.<br /><br />
					
					Jeśli wybierzesz <b>1 opcję</b> aktualność zostanie dodana do fotoblogu. <b>2 opcja</b> utworzy osobny artykuł wyświetlany na osobnej stronie przypisany 
					do kategorii, którą wybrałeś w poprzednm oknie. <b>3 opcja</b> przyłączy artykuł do górnego menu. <br><br>

					<label><input type="radio" value="1" name="typArtW" checked="checked" />
						Aktualnośc i artykuł mają być częścią blogu w postaci tekstu wyświetlanego w głównym ekranie
					</label><br /><br />
					<label><input type="radio" value="0" name="typArtW" />
						Artykuł będzię osobnym tekstem 
					</label><br /><br />
					<label><input type="radio" value="2" name="typArtW" />
						Artykuł będzię przypisany do górnego menu.
					</label>
					<br />
					<br />
					{gornemenu}
					<br />
					<br />
					<label><input type="checkbox" value="enableArt" name="enableArtW" checked="checked" id="enableArtW" />
						Artykuł ma być aktywny i widoczny
					</label><br />
					<label><input type="checkbox" value="enableGal" name="enableGalW" checked="checked" id="enableGalW" />
						Galeria dla danej aktualności ma być aktywna i dodana automatycznie z przypisanego folderu. 
					</label>
					<br />
					<br />
			</div>
		</div>
		<span class="error">
		</span>
		<div class="buttonSubPosition">
		<input type="submit" value="Zatwierdź" class="buttonSub" id="subW" />
		</div>
		</form>
    </div>
</div>