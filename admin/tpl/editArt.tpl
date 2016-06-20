<!-- OKNO EDYCJI ARTYKULU DLA ARTYKULU {index} ********************************************************************************************************************** -->
<div id="adminEditOkno" class="e{index}">
    <div id="adminEditZaw" class="e{index}">
    <form action="#" method="POST" id="formularz{index}">
    <div id="tabs{index}">
        
       <ul>
            <li><a href="#tab-e{index}1">Tytyły i autorzy</a></li>
            <li><a href="#tab-e{index}2">Tekst aktualności</a></li>
            <li><a href="#tab-e{index}3">Tekst artykułu</a></li>
            <li><a href="#tab-e{index}4">Tagi</a></li>
            <li><a href="#tab-e{index}5">Kategorie</a></li>
            <li><a href="#tab-e{index}6">Opcje</a></li>
        </ul>
       
        <div id="tab-e{index}1">
                <legend>Podaczas edycji aktualności możesz zmienić datę, treść aktualności jak również dodać artykuł.</legend>
                <br />
                Wpisz <b>tytuł aktualności</b> dodawanej do fotobloga <i>( pole wymagane )</i><br />
                <input name="tytulakt{index}" type="text"  size="60" minlength="5" class="formPoleText required" value="{tytulakt}" id="tytulAkt{index}" /><br />
                Podaj<strong> imię i nazwisko</strong> lub <strong>nica</strong> osoby która jest autorem zdjęć. 
                Jeżeli nie ma konkretnej osoby pozostaw wpis <strong>BRAK</strong><br />
                <input name="tytulart{index}" type="text" size="60" minlength="4" class="formPoleText required" value="{tytulart}" id="tytulArt{index}"/><br />
                Podaj <b>datę publikacji aktualności</b>. Aktualności są sortowane według daty <i>( pole wymagane )</i><br />
                <input  id="datepicker{index}" type="text"  name="dataAkt{index}" class="formPoleText required" value="{data}" /><br />
                Podaj <b>autora</b> tego tej publikacji. Może być to również autor zdjęć. 
                Jeśli jest więcej autorów oddziel ich przecinkiem <i>( pole wymagane )</i><br />
                <input name="autor{index}" type="text"  size="40" minlength="6" class="formPoleText required" value="{autor}" id="autor{index}"/><br />
        </div>
        <div id="tab-e{index}2">
                <legend>Edytuj <b>treść aktualności</b>. Pamiętaj, że w tym miejscu powinna znajdować się, 
                krótka informacja. Dla dłuższego artykułu masz miejsce 
                w następnym kroku - Tekst artykułu.</legend> 
                <textarea name="textAkt{index}" style="width:100%" rows="30" id="textAkt{index}" class="required">{tekstAkt}</textarea>
        </div>
        <div id="tab-e{index}3">
                <legend>Edytuj <b>treść artykułu przypisanego do tej aktualności</b>. 
                Jeżeli w pierwszym oknie nie podałeś tutułu aktualności i 
                pozostawiłeś "Brak" to treść artykułu i tak nie zostanie dodana. Jeśli artykuł 
                ma być dodany to wymagany jest <b>tytuł artykułu</b> 
                w pierwszym oknie. Może byc taki sam jak tytuł aktualności.</legend>
                <textarea name="textArt{index}" style="width:100%" rows="30" id="textArt{index}" class="required" id="textArt{index}">{tekstArt}</textarea>
        </div>
        <div id="tab-e{index}4">
                <legend>W tym miejscu możesz edytować tagi dla danej aktualności.</legend>
                
                Klikając <b>wybierz tagi</b>, które są powiązane z tym artykułem. 
                Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych tagów.  <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Musisz wybrać choć <b>jeden tag</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <div id="tagEdit{index}">
                BLAD ZALADOWANIA TAGOW Z BAZY DANYCH
                </div>
                
                <input name="tagAktE{index}" id="tagAktE{index}" type="text"  size="90" minlength="5" class="formPoleText required" value="{tagi}" /><br />
                
        </div>
        <div id="tab-e{index}5">
                <legend>W tym miejscu możesz zmienić lub usunać albo dodać kategorię do tego artykułu lub aktualności.</legend>
                Klikając <b>wybierz kategorię</b>, które są powiązane z tym artykułem. <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych kategorii. Musisz wybrać choć <b>jedną kategorię</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <div id="katEdit{index}">
                BLAD ZALADOWANIA KATEGORII Z BAZY DANYCH
                </div>                  
                <input name="katAktE{index}" id="katAktE{index}" type="text"  size="90" minlength="5" class="formPoleText required" value="{kategorie}" /><br />
                
        </div>
         <div id="tab-e{index}6">
                <legend>Ustawienia dla aktualności i artykułów.</legend>
                Zaznaczając odpowiednie pola możesz zdecydować czy dodawany artykuł będzie częścią fotobloga wyświetlaną w głównym oknie
                czy jedna pozostanie samodzielnym artykułem do ktorego przypiszesz odpowienią kategorię wybraną w poprzednim oknie.<br /><br />
                <label>{radioArt1}
                    Aktualnośc i artykuł mają być częścią blogu w postaci tekstu wyświetlanego w głównym ekranie
                </label><br /><br />
                <label>{radioArt2}
                    Artykuł będzię osobnym tekstem 
                </label><br /><br />
                <label>{radioArt3}
                    Artykuł będzię przypisany do górnego menu.
                </label>
                <br />
                <br />
                {gornemenu}
           		<br />
                <br />
                <label>{checkBoxArt1}
                    Artykuł ma być aktywny i widoczny
                </label><br />
                <label>{checkBoxArt2}
                    Galeria dla danej aktualności ma być aktywna i dodana automatycznie z przypisanego folderu. 
                </label>
                <br />
                <br />
                
        </div>
    </div>
    <div class="buttonSubPosition">
    <input type="submit" value="Zatwierdź" class="buttonSub" id="sub{index}" />
    </div>
    <input type="hidden" id="idArt{index}" value="{id}" />
    </form>
    </div>
</div>

<!-- OKNO DODAWANIA PLIKÓW arttykul {index}********************************************************************************************************* -->
<div id="adminFileOkno" class="f{index}">
    <div id="adminFileZaw" class="f{index}">
        <iframe id="iframeFilemenager" src="{pathfile}filemenager/dialog.php?type=0&field_id=fieldID&nrArt={galPicId}"></iframe>
    </div>
</div>