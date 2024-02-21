# Wypożyczalnia książek

REST API wypożyczalni książek

### Generowane Bearer Token

```http
  GET /token/generate
```

#### Request

*`email` - Email użytkownik

*`password` - Hasło użytkownika

#### Response
`token` - Bearer Token
### Lista książek

```http
  GET /books
```

#### Request

`page` - Numner strony (paginacja 20 książek na strone)

`search` - Szukana fraza. Szuka w nazwie i autorze książki oraz imieniu i nazwisku osoby która wyporzyczyła książke

#### Response
`data` - Wyszukane książki (tablica):
  - `name` - nazwa 
  - `status` - status (available | unavailable | not returned)
  - `client` - Osoba wyporzyczająca książke (nullable)
    - `name` - imię
    - `surname` - nazwisko
`links` - Linki paginacji

`meta` - Meta dane paginacji

### Właściwości książki

```http
  GET /books/{book}
```

#### Request

*`book` - id książki

#### Response
`data` - Dane książki
  - `name` - nazwa 
  - `author` - autor 
  - `realase_year` - rok publikacji 
  - `publisher` - wydawca 
  - `status` - status (available | unavailable | not returned)
  - `client` - Osoba wyporzyczająca książke (nullable)
    - `name` - imię
    - `surname` - nazwisko



### Wyporzyczenie książki

```http
  PATCH /books/{book}/borrow
```
#### Authorize

Książka musi być dostępna i użytkownik musi być zalogowany

#### Request

*`book` - id książki

`days` - Na ile dni książka jest wyporzyczana (min 3, max 60). Domyślna wartość to 30

`client_id` - id klienta który wyporzycza książke. To pole jest wymagane tylko jeśli request pochodzi od admina. W innym wypadku wyporzyczającym książke jest klient od którego pochodzi request

#### Response
`status` - status żądania

`message` - wiadomość zwrotna







### Zwracanie książki

```http
  PATCH /books/{book}/return
```
#### Authorize

Książka musi być w wyporzyczeniu i request musi pochodzić od admina lub klienta wyporzyczającego książke

#### Request

*`book` - id książki

#### Response
`status` - status żądania
`message` - wiadomość zwrotna






### Lista klientów

```http
  GET /clients
```

#### Response
`data` - Dane klientów (tablica):
  - `name` - imię
  - `surname` - nazwisko
### Dane klienta

```http
  GET /clients/{client}
```
#### Request
*`client` - id klienta (użytkownika)

#### Response
`data` - Dane klienta:
  - `name` - imię
  - `surname` - nazwisko
  - `books` - wyporzyczone książki (tablica)
    - `name` - nazwa 
    - `status` - status (available | unavailable | not returned)

### Tworzenie klienta

```http
  POST /clients
```
#### Authorize

Request musi pochodzić od admina

#### Request
*`email` - email. Wymagany i unikalny

*`password` - hasło. Wymagane. Min 8, maks 25 znaków

*`name` - imię. Wymagane. Min 3, maks 15 znaków

*`surname` - nazwisko. Wymagane. Min 3, maks 15 znaków

#### Response
`status` - status żądania

`message` - wiadomość zwrotna

`client` - dane klienta
  - `name` - imię
  - `surname` - nazwisko

### Usuwanie klienta

```http
  DELETE /clients/{client}
```
#### Authorize

Request musi pochodzić od admina, a usuwany użytkownik musi być klientem

#### Request
*`client` - id klienta (użytkownika)

#### Response
`status` - status żądania

`message` - wiadomość zwrotna
