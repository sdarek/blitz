# Blitz
Baza danych erd: https://dbdiagram.io/d/BlitzBaza-654be78f7d8bbd6465c9f910

Blitz to aplikacja webowa umożliwiająca przeglądanie produktów, logowanie, zakładanie konta, dodawanie produktów (jako admin) oraz interakcję z koszykiem zakupowym.

## Funkcje

1. **Przeglądanie Produktów:**
    - Klienci mogą przeglądać dostępne produkty, sortować je według kategorii, cen, itp.

2. **Logowanie i Zakładanie Konta:**
    - Klienci mogą utworzyć konto lub zalogować się, aby uzyskać dostęp do dodatkowych funkcji, takich jak koszyk i historia zamówień.

3. **Dodawanie do Koszyka:**
    - Zalogowani użytkownicy mogą dodawać produkty do koszyka zakupowego.

4. **Dodawanie Produktów (Admin):**
    - Administratorzy mają możliwość dodawania nowych produktów do sklepu.

## Technologie

- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Baza Danych:** PostgreSQL
- **Konteneryzacja:** Docker, Docker Compose

## Uruchomienie za pomocą Docker Compose
1. **Skopiuj Repozytorium:**
   ```bash
   git clone https://github.com/sdarjusz/Blitz.git
   cd Blitz
   docker-compose build
   docker-compose up


