# WORD
Założenia projektowe
System rezerwacji zasobów WORD Przemyśl
Aplikacje Internetowe
11.05.2020r.
Krystian Matusz
Wstęp
System będzie obejmować usprawnienie rezerwacji zasobów w WORD Przemyśl z działalności pozaegzaminacyjnej. Wynajmu pojazdów, placu manewrowego itp. W oparciu o możliwość rezerwacji przez sieć Internet zarówno za pomocą PC jak i urządzeń mobilnych. 
Konstrukcja będzie się składać z landingpage oraz kilku podstron, natomiast miejscem przechowywania danych będzie relacyjna baza. Relacyjna baza danych to rodzaj bazy danych, który pozwala przechowywać powiązane ze sobą elementy danych i zapewnia do nich dostęp. Relacyjne bazy danych są oparte na modelu relacyjnym — jest to prosty i intuicyjny sposób przedstawiania danych w tabelach. W relacyjnej bazie danych każdy wiersz tabeli jest rekordem z unikatowym identyfikatorem nazywanym kluczem. Kolumny tabeli zawierają atrybuty danych, a każdy rekord zawiera zwykle wartość dla każdego atrybutu, co ułatwia ustalenie relacji między poszczególnymi elementami danymi.  

Założenia projektowe
Będzie obejmować następujące role użytkowników:
    • osobę 	rezerwującą - użytkownika,
 	
    • obsługę rezerwacji - operator decydent, Administrator.

Założenia funkcjonalne
Tworzenie konta z dostępem do kalendarza.
Rezerwacje w oparciu o interaktywny kalendarz.
Możliwość rozbudowy o dodatkowe usługi.
Założenia niefunkcjonalne
 Aplikacja jest dostępna na komputery oraz urządzenia mobilne, z dostępem do Internetu, poprzez dowolną przeglądarkę internetową.
Projekt
Rezerwacja placu manewrowego na pojeździe z zewnątrz lub wynajęcie placu + pojazdu.
Wzajemne wykluczanie się rezerwacji np. Jednocześnie można wynajmować plac tylko dla jednego pojazdu ciężarowego i trzech na kat. B.
Inny przykład: wynajęcie dla pojazdu kat motocyklowych np. A (i tylko np. W środy) automatycznie blokuje możliwość wynajmu dla kat ciężarowych- względy bezpieczeństwa oraz bezpośrednia bliskość stanowisk.Poza wymienionym wcześniej aplikacja będzie oferowała podstawowe funkcjonalności niezbędne do działania systemu w przejrzystym i czytelnym menu w centralnej części witryny a także podstawowe informacje dotyczące aktualności. Funkcjonalności takie jak: utworzenie konta, logowanie, rezerwacje itp. Dla zwykłego użytkownika, natomiast dla administratora także przegląd i edycja rezerwacji, przegląd i edycja użytkowników - aktywacja konta, przegląd i edycja pojazdów wraz z ich dostępnością.
Strona będzie w pełni responsywna oraz interaktywna, aby na każdym rodzaju urządzenia z przeglądarką internetową można było używać wszystkich funkcji.



Diagram związków encji. ERD
W ramach projektu zrealizowane zostaną poszczególne założenia:
- landing page, oraz kilka podstron,
-składanie rezerwacji,
-przeglądanie zdjęć pojazdów WORD,
-panelu administratora umożliwiającego zarządzanie systemem.



Moduły i gotowa aplikacja:
Landing Page

Animowane przejście do Systemu.
Rysunek struktury aplikacji- strona główna
Moduł rejestracji
Widok administratora po zalogowaniu- rezerwacje oraz menu.
Menu pojazdy - określa dostępne pojazdy oraz umożliwia ustalenie w jakich dniach i godzinach są dostępne do wynajęcia.
Menu klientów - umożliwia ręczną aktywację konta oraz edycje użytkowników.
Menu dodawania pojazdu wraz z godzinami
Menu do rozbudowy w przyszłości - dodatkowe zlecenia jak np. zamówienie instruktora.(częściowo działa)
Menu po zalogowaniu użytkownika
Dodawanie rezerwacji 
Widok listy po dodaniu rezerwacji


Opis wykorzystanych narzędzi
Html, PHP , css, javascript, framework – (bootstrap), baza sql
Repozytorium
https://github.com/rychukrychu/word
Po dopracowaniu/testowaniu zostanie uruchomiona na głównej stronie WORD.

