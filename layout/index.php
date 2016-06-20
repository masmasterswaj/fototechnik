<?php
# ************************************************************************************************************************************************************
# SKRYPT REJESTRACJI UZYTKOWNIKOW STRONY
# CREATED BY MACIEJ KOLANKIEWICZ (C) 2012
# ************************************************************************************************************************************************************
# ************************************************************************************************************************************************************
# OBSLUGA BLEDOW
# ************************************************************************************************************************************************************
	ini_set( 'display_errors' ,  1 ); 
# ************************************************************************************************************************************************************
# ZNAJDOWANIE UNIWERSALEJ SCIEZKI DOSTEPU DO PLIKU ORAZ OKRESLANIE JEGO LOKALIZACJI
# ************************************************************************************************************************************************************
	$lokalizator = 0;$path_file = "";clearstatcache();
	$name_file = substr($_SERVER['PHP_SELF'],strpos(strrev($_SERVER['PHP_SELF']),'/',0)*(-1));
	while(!file_exists($path_file."path.php")){$path_file = "";
	for($q=0; $q <=(substr_count($_SERVER['PHP_SELF'], "/"))-$lokalizator; $q++)
	$path_file = $path_file."../";$lokalizator++;}
# ************************************************************************************************************************************************************
# ZALADOWANIE MECHANIZMU INICJACYJNEGO
# ************************************************************************************************************************************************************
	include_once($path_file."initiation/initiation.php");
# ************************************************************************************************************************************************************
# ZALADOWANIE FUNKCJI JQUERY DLA STRONY 1
# ************************************************************************************************************************************************************
	include_once($path_file."function/functionjQuery.php");
# ************************************************************************************************************************************************************
# ************************************************************************************************************************************************************
# WARTOSC ILOSCI ARTYKULOW NA STRON ZWIAZANA ZE SKRYPTAMI JQUERY I ICH GENEROWANIEM PRZEZ PHP
# ************************************************************************************************************************************************************
	$ilelement = 2;
# ************************************************************************************************************************************************************
?>
</head>
<body>	
<div id="fb-root"></div>
<!-- OKNA TEL DLA OKIEN ADMINISTRACYJNYCH  ******************************************************************************************************************* -->
<div id="tlo1"></div> 
<div id="tlo2"></div> 
<div id="tlo3"></div> 
<div id="tlo4"></div> 
<div id="tlo5"></div> 
<div id="tlo6"></div> 
    
<!-- OKNO UTWORZENIA NOWEGO ARTYKUŁU ************************************************************************************************************************* -->
<div id="adminWriteOkno">
    <div id="adminWriteZaw">
    <form action="#" method="get" id="formularzW">
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
                <input name="tytulAktW" type="text"  size="60" minlength="5" class="formPoleText required" /><br />
                Wpisz <b>tytuł artykułu</b> jeśli będzie dodany do tej aktualności. Jeśli w tej aktualności nie będzie 
                przewidzany artykuł pozostaw tam wpis <b>"Brak"</b> ( pole wymagane )<br />
                <input name="tytulArtW" type="text"  size="60" minlength="4" value="Brak" class="formPoleText required" /><br />
                Podaj <b>datę publikacji aktualności</b>. Aktualności są sortowane według daty <i>( pole wymagane )</i><br />
                <input  id="datepickerW" type="text"  name="dataAktW" class="formPoleText required" /><br />
                Podaj <b>autora</b> tego tej publikacji. Może być to również autor zdjęć. Jeśli jest więcej autorów oddziel ich przecinkiem <i>( pole wymagane )</i><br />
                <input name="autorW" type="text"  size="40" minlength="6" class="formPoleText required" /><br />
        </div>
        <div id="tab-w012">
                <legend>Napisz <b>treść aktualności</b>. Pamiętaj, że w tym miejscu powinna znajdować się, krótka informacja. Dla dłuższego artykułu masz miejsce 
                w następnym kroku - Tekst artykułu.</legend> 
                <textarea name="textAktW" style="width:100%" id="textAktW" class="required"></textarea>
        </div>
        <div id="tab-w013">
                <legend>Napisz <b>treść artykułu przypisanego do tej aktualności</b>. Jeżeli w pierwszym oknie nie podałeś tutułu aktualności i 
                pozostawiłeś "Brak" to treść artykułu i tak nie zostanie dodana. Jeśli artykuł ma być dodany to wymagany jest <b>tytuł artykułu</b> 
                w pierwszym oknie. Może byc taki sam jak tytuł aktualności.</legend>
                <textarea name="textArtW" style="width:100%" id="textArtW" class="required"></textarea>
        </div>
        <div id="tab-w014">
                <legend>W tym miejscu możesz przypisać tagi dla danej aktualności.</legend>
                
                Klikając <b>wybierz tagi</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych tagów. Musisz wybrać choć <b>jeden tag</b> dla tego artykułu lub aktualności.( pole wymagane )</i><br />
     
                <div id="adminWriteTag">
                BLAD ZALADOWANIA TAGOW Z BAZY DANYCH
                </div>
                
                <input name="tagAktW" id="tagAktW" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
        <div id="tab-w015">
                <legend>W tym miejscu możesz przypisać artykuł i aktualność do odpowiedniej kategorii.</legend>
                Klikając <b>wybierz kategorię</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych kategorii. Musisz wybrać choć <b>jedną kategorię</b> dla tego artykułu lub aktualności.( pole wymagane )</i><br />
     
                <div id="adminWriteKat">
                BLAD ZALADOWANIA KATEGORII Z BAZY DANYCH
                </div>                     
                <input name="katAktW" id="katAktW" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
         <div id="tab-w016">
                <legend>Ustawienia dla aktualności i artykułów.</legend>
                Zaznaczając odpowiednie pola możesz zdecydować czy dodawany artykuł będzie częścią fotobloga wyświetlaną w głównym oknie
                czy jedna pozostanie samodzielnym artykułem do ktorego przypiszesz odpowienią kategorię wybraną w poprzednim oknie.<br /><br />
                
                Jeśli wybierzesz <b>1 opcję</b> aktualność zostanie dodana do fotoblogu. <b>2 opcja</b> utworzy osobny artykuł wyświetlany na osobnej stronie przypisany 
                do kategorii, którą wybrałeś w poprzednm oknie. <b>3 opcja</b> przyłączy artykuł do górnego menu. <br><br>

                <label><input type="radio" value="1" name="typArt" checked="checked" />
                    Aktualnośc i artykuł mają być częścią blogu w postaci tekstu wyświetlanego w głównym ekranie
                </label><br /><br />
                <label><input type="radio" value="2" name="typArt" />
                    Artykuł będzię osobnym tekstem 
                </label><br /><br />
                <label><input type="radio" value="2" name="typArt" />
                    Artykuł będzię przypisany do górnego menu.
                </label><br /><br />
                <label><input type="checkbox" value="enableArt" name="enableArt" checked="checked" />
                    Artykuł ma być aktywny i widoczny
                </label><br />
                <label><input type="checkbox" value="enableGal" name="enableGal" checked="checked" />
                    Galeria dla danej aktualności ma być aktywna i dodana automatycznie z przypisanego folderu. 
                </label><br />
                <label><input type="checkbox" value="titlePic1" name="enableGal" />
                    Nazwy plików zdjęć jako tytuł zdjęcia
                </label><br />


                <br />
                
        </div>
    </div>
    <div class="buttonSubPosition">
    <input type="submit" value="Zatwierdź" class="buttonSub" id="subW" />
    <input type="button" value="Anuluj" class="buttonSub" id="anaW" />
    </div>
    </form>
    </div>
</div>
<!-- OKNO DODAWANIA TAGÓW *************************************************************************************************************************************** -->
<div id="adminTagOkno">
    <div id="adminTagZaw">
        <div id="tabsTag">
            <ul>
                <li><a href="#tab-tag01">Usuwanie i dodawanie tagów</a></li>
            </ul>
            <div id="tab-tag01">
            	W tym miejscu możesz usuwać i dodawać TAGI do pożniejszego przypisywania ich do artykułów i aktualności. Pojedyńcze kliknięcie 
                powoduje dodanie TAGA do listy. Powtóne kliknięcie usuwa go z listy do usunięcia. <br />
				Przy dodawaniu nowych TAGÓW możesz podać kilka oddzielając je przecinkami. TAG może składać się również z wielu wyrazów.
                <br />
                <br />
                <div id="divTagAdd1">
                BŁĄD - Dane nie przeszły z bazy danych
                </div>
                <br />
                <br />
                <br />
                <div id="formTagAdd1">
                	<br>
                    <label for="textTagAdd1">Podaj nowy TAG lub grupę TAGÓW podając je po przecinkach</label><br />
                    <input type="text" size="30" name="textTagAdd1" id="textTagAdd1" value="" class="formPoleText" />
                    <input type="submit" value="Dodaj" name="butTagAdd1" id="butTagAdd1" class="buttonSub" />
                </div>
                <br />
                <label for="tagAdd1">Kliknij na tagu aby dodać go do usunięcia. Drugie kliknięcie na tagu usunie go z listy</label><br />
                <input type="text" id="tagAdd1" value="" name="tagAdd1" size="90" class="formPoleText" />
                <input type="submit" value="Usuń tagi" name="butTagDel1" id="butTagDel1" class="buttonSub" />
             </div>
        </div>
    <div class="buttonSubPosition">
    <input type="button" value="Zamknij" class="buttonSub" id="anaTag" />
    </div>
    </div>
</div>
<!-- OKNO DODAWANIA KATEGORII ********************************************************************************************************************************** -->
<div id="adminKatOkno">
    <div id="adminKatZaw">
        <div id="tabsKat">
            <ul>
                <li><a href="#tab-kat01">Usuwanie i dodawanie kategorii</a></li>
            </ul>
            <div id="tab-kat01">
           		W tym miejscu możesz usuwać i dodawać KATEGORIĘ do pożniejszego przypisywania ich do artykułów i aktualności. Pojedyńcze kliknięcie 
                powoduje dodanie KATEGORII do listy. Powtóne kliknięcie usuwa ją z listy do usunięcia. <br />
				Przy dodawaniu nowych KATEGORII możesz podać kilka oddzielając je przecinkami. KATEGORIĘ może składać się również z wielu wyrazów. Pamiętaj jednak 
                o ograniczeniu szerokości pola menu KATEGORII, które ma swoje ograniczenia. 
                <br />
                <br />
                <div id="divKatAdd1">
                BŁĄD - Dane nie przeszły z bazy danych
                </div>
                <br />
                <br />
                <br />
                <div id="formKatAdd1">
                    <label for="textKatAdd1">Podaj nową KATEGORIĘ lub grupę KATEGORII podając je po przecinkach</label><br />
                    <input type="text" size="30" name="textKatAdd1" id="textKatAdd1" value="" class="formPoleText" />
                    <input type="submit" value="Dodaj kategorię" name="butKatAdd1" id="butKatAdd1" class="buttonSub" />
                </div>
                <br />
                <label for="katAdd1">Kliknij na KATEGORII aby dodać ją do usunięcia. Drugie kliknięcie na KATEGORII usunie ją z listy</label><br />
                <input type="text" id="katAdd1" value="" name="katAdd1" size="90" class="formPoleText" />
                <input type="submit" value="Usuń kategorię" name="butKatDel1" id="butKatDel1" class="buttonSub" />
            </div>
        </div>
        <div class="buttonSubPosition">
        <input type="button" value="Zamknij" class="buttonSub" id="anaKat" />
        </div>
    </div>
</div>
<!-- OKNO EDYCJI ARTYKULU DLA ARTYKULU 01 ********************************************************************************************************************** -->
<div id="adminEditOkno" class="e01">
    <div id="adminEditZaw" class="e01">
    <form action="#" method="get" id="formularz01">
    <div id="tabs01">
        
       <ul>
            <li><a href="#tab-e011">Tytyły i autorzy</a></li>
            <li><a href="#tab-e012">Tekst aktualności</a></li>
            <li><a href="#tab-e013">Tekst artykułu</a></li>
            <li><a href="#tab-e014">Tagi</a></li>
            <li><a href="#tab-e015">Kategorie</a></li>
            <li><a href="#tab-e016">Opcje</a></li>
        </ul>
       
        <div id="tab-e011">
                <legend>Podaczas edycji aktualności możesz zmienić datę, treść aktualności jak również dodać artykuł.</legend>
                <br />
                Wpisz <b>tytuł aktualności</b> dodawanej do fotobloga <i>( pole wymagane )</i><br />
                <input name="tytulAkt01" type="text"  size="60" minlength="5" class="formPoleText required" /><br />
                Wpisz <b>tytuł artykułu</b> jeśli będzie dodany do tej aktualności. Jeśli w tej aktualności nie będzie 
                przewidzany artykuł pozostaw tam wpis <b>"Brak"</b> ( pole wymagane )<br />
                <input name="tytulArt01" type="text"  size="60" minlength="4" value="Brak" class="formPoleText required" /><br />
                Podaj <b>datę publikacji aktualności</b>. Aktualności są sortowane według daty <i>( pole wymagane )</i><br />
                <input  id="datepicker01" type="text"  name="dataAkt01" class="formPoleText required" /><br />
                Podaj <b>autora</b> tego tej publikacji. Może być to również autor zdjęć. Jeśli jest więcej autorów oddziel ich przecinkiem <i>( pole wymagane )</i><br />
                <input name="autor01" type="text"  size="40" minlength="6" class="formPoleText required" /><br />
        </div>
        <div id="tab-e012">
                <legend>Edytuj <b>treść aktualności</b>. Pamiętaj, że w tym miejscu powinna znajdować się, krótka informacja. Dla dłuższego artykułu masz miejsce 
                w następnym kroku - Tekst artykułu.</legend> 
                <textarea name="textAkt01" style="width:100%" id="textAkt01" class="required"></textarea>
        </div>
        <div id="tab-e013">
                <legend>Edytuj <b>treść artykułu przypisanego do tej aktualności</b>. Jeżeli w pierwszym oknie nie podałeś tutułu aktualności i 
                pozostawiłeś "Brak" to treść artykułu i tak nie zostanie dodana. Jeśli artykuł ma być dodany to wymagany jest <b>tytuł artykułu</b> 
                w pierwszym oknie. Może byc taki sam jak tytuł aktualności.</legend>
                <textarea name="textArt01" style="width:100%" id="textArt01" class="required"></textarea>
        </div>
        <div id="tab-e014">
                <legend>W tym miejscu możesz edytować tagi dla danej aktualności.</legend>
                
                Klikając <b>wybierz tagi</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych tagów.  <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Musisz wybrać choć <b>jeden tag</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <div id="tagEdit01">
                BLAD ZALADOWANIA TAGOW Z BAZY DANYCH
                </div>
                
                <input name="tagAktE01" id="tagAktE01" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
        <div id="tab-e015">
                <legend>W tym miejscu możesz zmienić lub usunać albo dodać kategorię do tego artykułu lub aktualności.</legend>
                Klikając <b>wybierz kategorię</b>, które są powiązane z tym artykułem. <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych kategorii. Musisz wybrać choć <b>jedną kategorię</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <div id="katEdit01">
                BLAD ZALADOWANIA KATEGORII Z BAZY DANYCH
                </div>                  
                <input name="katAktE01" id="katAktE01" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
         <div id="tab-e016">
                <legend>Ustawienia dla aktualności i artykułów.</legend>
                Zaznaczając odpowiednie pola możesz zdecydować czy dodawany artykuł będzie częścią fotobloga wyświetlaną w głównym oknie
                czy jedna pozostanie samodzielnym artykułem do ktorego przypiszesz odpowienią kategorię wybraną w poprzednim oknie.<br /><br />
                <label><input type="radio" value="1" name="typArt" checked="checked" />
                    Aktualnośc i artykuł mają być częścią blogu w postaci tekstu wyświetlanego w głównym ekranie
                </label><br /><br />
                <label><input type="radio" value="2" name="typArt" />
                    Artykuł będzię osobnym tekstem 
                </label><br /><br />
                <label><input type="checkbox" value="enableArt" name="enableArt" checked="checked" />
                    Artykuł ma być aktywny i widoczny
                </label><br />
                <label><input type="checkbox" value="enableGal" name="enableGal" checked="checked" />
                    Galeria dla danej aktualności ma być aktywna i dodana automatycznie z przypisanego folderu. 
                </label><br />

                <br />
                
        </div>
    </div>
    <div class="buttonSubPosition">
    <input type="submit" value="Zatwierdź" class="buttonSub" id="sub01" />
    <input type="button" value="Anuluj" class="buttonSub" id="ana01" />
    </div>
    </form>
    </div>
</div>

<!-- OKNO EDYCJI ARTYKULU DLA ARTYKULU 02 *************************************************************************************************** -->
<div id="adminEditOkno" class="e02">
    <div id="adminEditZaw" class="e02">
    <form action="#" method="get" id="formularz02">
    <div id="tabs02">
        
       <ul>
            <li><a href="#tab-e021">Tytyły i autorzy</a></li>
            <li><a href="#tab-e022">Tekst aktualności</a></li>
            <li><a href="#tab-e023">Tekst artykułu</a></li>
            <li><a href="#tab-e024">Tagi</a></li>
            <li><a href="#tab-e025">Kategorie</a></li>
            <li><a href="#tab-e026">Opcje</a></li>
        </ul>
       
        <div id="tab-e021">
                <legend>Podaczas edycji aktualności możesz zmienić datę, treść aktualności jak również dodać artykuł.</legend>
                <br />
                Wpisz <b>tytuł aktualności</b> dodawanej do fotobloga <i>( pole wymagane )</i><br />
                <input name="tytulAkt02" type="text"  size="60" minlength="5" class="formPoleText required" /><br />
                Wpisz <b>tytuł artykułu</b> jeśli będzie dodany do tej aktualności. Jeśli w tej aktualności nie będzie 
                przewidzany artykuł pozostaw tam wpis <b>"Brak"</b> ( pole wymagane )<br />
                <input name="tytulArt02" type="text"  size="60" minlength="4" value="Brak" class="formPoleText required" /><br />
                Podaj <b>datę publikacji aktualności</b>. Aktualności są sortowane według daty <i>( pole wymagane )</i><br />
                <input  id="datepicker02" type="text"  name="dataAkt02" class="formPoleText required" /><br />
                Podaj <b>autora</b> tego tej publikacji. Może być to również autor zdjęć. Jeśli jest więcej autorów oddziel ich przecinkiem <i>( pole wymagane )</i><br />
                <input name="autor02" type="text"  size="40" minlength="6" class="formPoleText required" /><br />
        </div>
        <div id="tab-e022">
                <legend>Edytuj <b>treść aktualności</b>. Pamiętaj, że w tym miejscu powinna znajdować się, krótka informacja. Dla dłuższego artykułu masz miejsce 
                w następnym kroku - Tekst artykułu.</legend> 
                <textarea name="textAkt02" style="width:100%" id="textAkt02" class="required"></textarea>
        </div>
        <div id="tab-e023">
                <legend>Edytuj <b>treść artykułu przypisanego do tej aktualności</b>. Jeżeli w pierwszym oknie nie podałeś tutułu aktualności i 
                pozostawiłeś "Brak" to treść artykułu i tak nie zostanie dodana. Jeśli artykuł ma być dodany to wymagany jest <b>tytuł artykułu</b> 
                w pierwszym oknie. Może byc taki sam jak tytuł aktualności.</legend>
                <textarea name="textArt02" style="width:100%" id="textArt02" class="required"></textarea>
        </div>
        <div id="tab-e024">
                <legend>W tym miejscu możesz edytować tagi dla danej aktualności.</legend>
                
                Klikając <b>wybierz tagi</b>, które są powiązane z tym artykułem. Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych tagów.  <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Musisz wybrać choć <b>jeden tag</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <a href="#"><div class="tagAktE02">polityka</div></a>
                <a href="#"><div class="tagAktE02">wybory</div></a>
                <a href="#"><div class="tagAktE02">heheszki</div></a>
                <a href="#"><div class="tagAktE02">muzyka</div></a>
                <a href="#"><div class="tagAktE02">knp</div></a>
                <a href="#"><div class="tagAktE02">korwin</div></a>
                <a href="#"><div class="tagAktE02">polska</div></a>
                <a href="#"><div class="tagAktE02">pytanie</div></a>
                <a href="#"><div class="tagAktE02">ciekawostki</div></a>
                <a href="#"><div class="tagAktE02">nsfw</div></a>
                <a href="#"><div class="tagAktE02">ladnapani</div></a>
                <a href="#"><div class="tagAktE02">mirkoelektronika</div></a>
                <a href="#"><div class="tagAktE02">rowerowyrownik</div></a>
                <a href="#"><div class="tagAktE02">humorobrazkowy</div></a>
                <a href="#"><div class="tagAktE02">jaruzelski</div></a>
                <a href="#"><div class="tagAktE02">motoryzacja</div></a>
                <a href="#"><div class="tagAktE02">tibiazwykopem</div></a>
                
                <input name="tagAktE02" id="tagAktE02" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
        <div id="tab-e025">
                <legend>W tym miejscu możesz zmienić lub usunać albo dodać kategorię do tego artykułu lub aktualności.</legend>
                Klikając <b>wybierz kategorię</b>, które są powiązane z tym artykułem. <b>Pierwsze kliknięcie dodaje, drugie, usuwa.</b>
                Jeśli chcesz <b>dodać nowe</b> musisz wyjść z tej edycji i wejść w opcję 
                dodawania nowych kategorii. Musisz wybrać choć <b>jedną kategorię</b> dla tego artykułu lub aktualności.<i>( pole wymagane )</i><br />
     
                <a href="#"><div class="katAktE02">Prace / Nasze prace</div></a>
                <a href="#"><div class="katAktE02">Zdjęcia</div></a>
                <a href="#"><div class="katAktE02">Nasze sukcesy</div></a>
                <a href="#"><div class="katAktE02">Konkursy</div></a>
                <a href="#"><div class="katAktE02">Inspiracje</div></a>
                <a href="#"><div class="katAktE02">Wystawy</div></a>
                <a href="#"><div class="katAktE02">Inne</div></a>                        
                <input name="katAktE02" id="katAktE02" type="text"  size="90" minlength="5" class="formPoleText required" /><br />
                
        </div>
         <div id="tab-e026">
                <legend>Ustawienia dla aktualności i artykułów.</legend>
                Zaznaczając odpowiednie pola możesz zdecydować czy dodawany artykuł będzie częścią fotobloga wyświetlaną w głównym oknie
                czy jedna pozostanie samodzielnym artykułem do ktorego przypiszesz odpowienią kategorię wybraną w poprzednim oknie.<br /><br />
                <label><input type="radio" value="1" name="typArt" checked="checked" />
                    Aktualnośc i artykuł mają być częścią blogu w postaci tekstu wyświetlanego w głównym ekranie
                </label><br /><br />
                <label><input type="radio" value="2" name="typArt" />
                    Artykuł będzię osobnym tekstem 
                </label><br /><br />
                <label><input type="checkbox" value="enableArt" name="enableArt" checked="checked" />
                    Artykuł ma być aktywny i widoczny
                </label><br />
                <label><input type="checkbox" value="enableGal" name="enableGal" checked="checked" />
                    Galeria dla danej aktualności ma być aktywna i dodana automatycznie z przypisanego folderu. 
                </label><br />

                <br />
                
        </div>
    </div>
    <div class="buttonSubPosition">
    <input type="submit" value="Zatwierdź" class="buttonSub" id="sub02" />
    <input type="button" value="Anuluj" class="buttonSub" id="ana02" />
    </div>
    </form>
    </div>
</div>
<!-- OKNO DODAWANIA PLIKÓW ********************************************************************************************************************* -->
<div id="adminFileOkno" class="f01">
    <div id="adminFileZaw" class="f01">
        <iframe id="iframeFilemenager" src="<?php echo $path_file;?>filemenager/dialog.php?type=0&field_id=fieldID&nrArt=00001"></iframe>
    </div>
</div>
<div id="adminFileOkno" class="f02">
    <div id="adminFileZaw" class="f02">
        <iframe id="iframeFilemenager" src="<?php echo $path_file;?>filemenager/dialog.php?type=0&field_id=fieldID&nrArt=00002"></iframe>
    </div>
</div>
<!-- OKNO USUWANIA ARTYKULU ********************************************************************************************************************* -->
<div id="adminDelOkno" class="d01">
    <div id="adminDelZaw" class="d01">
        Dupa01
    </div>
</div>
 <div id="adminDelOkno" class="d02">
    <div id="adminDelZaw" class="d02">
        Dupa02
    </div>
</div>
<div id="banner-pasek">
    <div id="banner-menu">
        <div id="banner-logo">
            <img src="../images/banner/logo.png" width="137" height="36" alt="Logo ZSŁ Poznań" />
            <br />
            Zespół Szkół Łączności im. Mikołaja Kopernika w Poznaniu
        </div>
        <div id="banner-lista">
            <ul id="menu-lista">	
                    <li><a href="#">szkoła</a>
                         <ul>
                            <li><a href="#" title="">oficjalna strona szkolna</a></li>
                            <li><a href="#" title="">wirtualna przechadzka po szkole</a></li>
                         </ul>
                    </li>
                    <li><a href="#" title="">kierunek</a>
                            <ul>
                                <li><a href="#" title="">kwalifikacje A20/A25</a></li>
                                <li><a href="#" title="">informacje o kierunku</a></li>
                                <li><a href="#" title="">film</a></li>
                            </ul>
                    </li>
                    <li><a href="#" title="">pracownie</a>
                         <ul>
                             <li><a href="#" title="">pracownia artystyczna</a></li>
                             <li><a href="#" title="">pracownia fotografii analogowej</a></li>
                             <li><a href="#" title="">pracownia fotografii cyfrowej</a></li>
                             <li><a href="#" title="">pracownia grafiki komputerowej</a></li>
                         </ul>
                    </li>
                    <li><a href="#" title="">rekrutacja</a>
                        <ul>
                            <li><a href="#" title="">drzwi otwarte</a></li>
                            <li><a href="#" title="">galeria</a></li>
                            <li><a href="#" title="">podsumownie naboru</a></li>
                        </ul>
                    </li>
                    <li><a href="#" title="">kontakt</a>
                     <ul>
                         <li><a href="#" title="">adres lokalizacja = i telefony</a></li>
                         <li><a href="#" title="">email</a></li>
                     </ul>
                    </li>
            </ul>
        </div>
    </div>
    
    <div id="banner-obrazek">
    </div>
    
    <div class="tresc-tlo">
        <div id="tresc-lewy">
            
            <!-- ARTYKUL 01 -------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tresc">
            <h2><span class="tytul-pom">Jakiś tam temat</span><span class="tytul-szary"> i jakaś aktualność</span></h2>
            <h5><span class="tytul-szary">Opublikowano</span> <span class="tytul-pom">25 maja 2014</span> <span class="tytul-szary">przez Jan Kowalski</span></h5>
            <br />
            <div class="adminButton">
                <a><div class="adminEdit" id="a01">
                <div><b>Edycja tego artykułu</b><br /><br />W tym miejscu można edytować poniższy tekst artykułu lub aktualności</div>
                </div></a>
                <a>
                <div class="adminWrite">
                <div><b>Dodanie nowego artykułu</b><br /><br />Dadanie nowego artykułu lub aktualności ustawi ją w zależności od ustawionej daty</div>
                </div></a>
                <a><div class="adminPic" id="a01">
                <div><b>Dodawanie i usuwanie zdjeć</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                <a><div class="adminDel" id="a01">
                <div><b>Usuń artykuł</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                <a><div class="adminTag">
                <div><b>Dodaj / usuń Tag</b><br /><br />Daje możliwości dodawania i usuwania tagów dla całego fotobloga</div>
                </div></a>
                <a><div class="adminKat">
                <div><b>Dodanie kategorii</b><br /><br />Dodawanie lub usuwanie kategorii dla całego fotobloga</div>
                </div></a>
            </div>
            <br />
            
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. 
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
            sed diamvoluptua. At
            <br /><br />
            <div class="tresc-zdjecie" id="art01">
                <a href="../images/zdjecia/02m.jpg" data-lightbox="10" title="moje caption">
                <img src="../images/zdjecia/02m.jpg" width="600" height="400" alt="zdjecie 01" class="duze" />
                </a>
                <a id="s01">
                    <div class="tresc-wiecej">
                    więcej<img src="../images/strzalka.png" width="13" height="11" id="strzalka"/>
                    </div>
                </a>
                <div class="fb-like" data-href="http://demotywatory.pl/4345438/My-nie-damy-rady" 
                data-layout="button_count" data-action="like" data-show-faces="true" data-share="true">
                </div>
                <div class="tresc-miniatury">
                    <a href="../images/zdjecia/02m.jpg" data-lightbox="01" title="moje caption">
                    <img src="../images/zdjecia/02s.jpg" />
                    </a>
                    <a href="../images/zdjecia/03m.jpg" data-lightbox="01">
                    <img src="../images/zdjecia/03s.jpg" />
                    </a>
                    <a href="../images/zdjecia/04m.jpg" data-lightbox="01">
                    <img src="../images/zdjecia/04s.jpg" />
                    </a>
                    <a href="../images/zdjecia/05m.jpg" data-lightbox="01">
                    <img src="../images/zdjecia/05s.jpg" />
                    </a>
                    <a href="../images/zdjecia/06m.jpg" data-lightbox="01">
                    <img src="../images/zdjecia/06s.jpg" />
                    </a>
                    <a href="../images/zdjecia/07m.jpg" data-lightbox="01">
                    <img src="../images/zdjecia/07s.jpg" />
                    </a>
                </div>
                <div class="tresc-artykul">
                <h5><span class="tytul-pom">fot:</span> <span class="tytul-szary"><strong>Jan Kowalski</strong></span></h5>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. 
                At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
                sed diamvoluptua. At
                </div>
                <div id="tresc-end">
                </div>
            </div>
            </div>
            <!-- ARTYKUL 02 -------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <div class="tresc">
            <h2><span class="tytul-pom">Inny jakiś temat</span><span class="tytul-szary"> i inna aktualność</span></h2>
            <h5><span class="tytul-szary">Opublikowano</span> <span class="tytul-pom">28 maja 2014</span> <span class="tytul-szary">przez Zdzichu Wiertara</span></h5>
            <br />
            <div class="adminButton">
                <a><div class="adminEdit" id="a02">
                <div><b>Edycja tego artykułu</b><br /><br />W tym miejscu można edytować poniższy tekst artykułu lub aktualności</div>
                </div></a>
                <a><div class="adminPic" id="a02">
                <div><b>Dodawanie i usuwanie zdjeć</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                <a><div class="adminDel" id="a02">
                <div><b>Usuń artykuł</b><br /><br />Dodaj lub usuń zdjęcia do tego artukułu lub aktualności</div>
                </div></a>
                
            </div>
            <br />
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. 
            At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
            sed diamvoluptua. At
            <br /><br />
            <div class="tresc-zdjecie" id="art02">
                <a href="../images/zdjecia/08m.jpg" data-lightbox="1" title="moje caption">
                <img src="../images/zdjecia/08m.jpg" width="600" height="400" alt="zdjecie 08" class="duze" />
                </a>
                <a id="s02">
                    <div class="tresc-wiecej">
                    więcej<img src="../images/strzalka.png" width="13" height="11" id="strzalka"/>
                    </div>
                </a>
                <div class="fb-like" data-href="http://demotywatory.pl/4345437/Do-lata-zostal-miesiac" 
                data-layout="button_count" data-action="like" data-show-faces="true" data-share="true">
                </div>
                <div class="tresc-miniatury">
                    <a href="../images/zdjecia/08m.jpg" data-lightbox="02" title="moje caption">
                    <img src="../images/zdjecia/08s.jpg" />
                    </a>
                    <a href="../images/zdjecia/09m.jpg" data-lightbox="02">
                    <img src="../images/zdjecia/09s.jpg" />
                    </a>
                    <a href="../images/zdjecia/10m.jpg" data-lightbox="02">
                    <img src="../images/zdjecia/10s.jpg" />
                    </a>
                    <a href="../images/zdjecia/11m.jpg" data-lightbox="02">
                    <img src="../images/zdjecia/11s.jpg" />
                    </a>
                    <a href="../images/zdjecia/12m.jpg" data-lightbox="02">
                    <img src="../images/zdjecia/12s.jpg" />
                    </a>
                </div>
                <div class="tresc-artykul">
                <h5><span class="tytul-pom">fot:</span> <span class="tytul-szary"><strong>Zdzichu Wiertara</strong></span></h5>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. 
                At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, 
                sed diamvoluptua. At
                </div>
                <div id="tresc-end">
                </div>
              </div>
            </div>
            </div>
             <!-- KATEGORIE -------------------------------------------------------------------------------------------------------------------------------------------------------------------->
            <div id="tresc-prawy">
            <h2><span class="tytul-pom">Kategorie</span></h2>
                <div id="kategorieLista">
                    BLAD MYSQL
                </div>
            <br><br>
            <h2><span class="tytul-pom">Tagi</span></h2>
                <div id="tagiStrona">
                    BLAD MYSQL                
                </div>
            </div>
            <div id="tresc-end">
            </div>
        </div>
    <div id="stopka">
        <div id="stopka-wew">
             <img src="../images/pepol.png" width="30" height="30" style="float:left; padding-right:10px"/>
            <div id="stopka-logowanie">
            Zaloguj się do strony:<br>
            <label>login: <input type="text" name="weblogin" id="login" /></label>
            <label>hasło: <input type="password" name="weblogin" id="login" /></label>
            <input type="submit" value="Zaloguj" />
             </div>
            <div id="stopka-info">
            <br><br>
            © 2014 Maciej Kolankiewicz <strong>MacCOM Multimedia</strong> dla ZSŁ Poznań
            </div>
        </div>
    </div>
</div>
</body>
</html>