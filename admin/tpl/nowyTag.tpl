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
    </div>
</div>