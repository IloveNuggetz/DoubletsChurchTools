# DoubletsChurchTools
## Stack
- Based on Symfony PHP Webframework
- Symfony using Doctrine ORM
- Deployment based on Docker (compose)
- MySql database

## Anleitung:
### Benötigt:
- Docker Engine + Docker compose
  - 19.03.1 + 1.24.1 wurde lokal verwendet, jedoch sollte wohl 	17.12.0 und höher, sowie 1.21.0 und höher funktionieren
  - https://docs.docker.com/compose/install/
- z.B. Postman als Schnittstellentesttool
  - https://www.postman.com/downloads/
- Git

### Installation:
1. Git repository klonen
2. Eine shell öffnen und in den Ort des Projekts springen (auf top-level struktur)
3. Die dort liegende docker-compose Datei ausführen per `docker-compose up`
4. Nachdem die benötigten Images geladen wurden (das könnte bis zu ein paar Minuten dauern) läuft das System
5. Erreichbar ist die **Api** unter **localhost:80** und die Datenbank unter **localhost:3306**. In der Komposition ist auch schon ein DB GUI Programm dabei "**Adminer**". Adminer ist erreichbar unter **localhost:8080**. Hier wird zum einloggen in die DB die Adresse der DB benötigt **localhost:3306**, den Namen der DB **testSym** und Zugangsdaten **User: user | Passwort: user**

### Nutzung:
1. Fürs Testen der Funktionen Postman ausführen
2. Im Browser **localhost:80/api/doc.json** aufrufen und die OpenApi Spec lokal speichern
3. Die heruntergeladene Datei in Postman importieren (links oben Knopf)
4. Postman müsste nun die zwei Funktionen (get doublets und post doublets/merge) haben. Die Spezifikation beinhaltet auch automatisch generierte Beispielaufrufe, vor allem für einen post doublets/merge Aufruf von großem Vorteil. Für einen doublets/merge würde ich ein Tool wie z.B. http://www.unit-conversion.info/texttools/replace-text/ empfehlen um den Request anzureichern (außer man hat starke Nerven und macht es händisch)
5. Für einen Merge muss hierbei neben den IDs der Dublette ein Schema ausgefüllt werden, in welchem für jedes Feld die ID der Entität steht, deren Wert für das Feld behalten werden soll.
6. Bei Fragen gerne erreichbar per Handy oder E-Mail
  
