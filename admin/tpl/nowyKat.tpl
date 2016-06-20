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
    </div>
</div>