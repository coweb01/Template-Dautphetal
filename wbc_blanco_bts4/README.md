# wbc_blanco_bts4-1.10

Blanco Template auf Basis von Bootstrap4.

Das Template lässt sich im Backend über Parameter grob konfigurieren.

Das Template generiert aus LESS Dateien im Verzeichnis /less die passenden CSS Dateien.
Eigene Styles können in der Datei custom.less eingebunden werden. Die Hauptfarben können über den  Template Style konfiguriert werden. Diese werden als LESS Variablen erstellt.
In der Datei Variables.less können zusätzliche Parameter erstellt werden.

Die Datei less.php im Verzeichnis includes ruft den Joomla Core Less Compiler auf.

Im Verzeichnis /includes befinden sich die einzelnen Komponenten des Templates und werden in der index.php aufgerufen.

Für das Hauptmenü gibt es verschiedene overrides. 

AKdropdownmenu erzeugt ein mehrspaltiges Dropdown mit Bootstrap 4. Ausserdem unterstützt dieser Override AccessKeys. Für diese Funktionalität wird ein zusätzliches Plugin benötigt.
Zu finden auf https://github.com/coweb01/CustomMenuParams

icon erzeugt ein Menü mit FontAwesome Icons. Die Klasse für das Icon muss im Menüeintrag im Link eingetragen werden. (CSS Klasse für den Link). Das Aussehen kann über CSS angepasst werden.

overlay erzeugt ein Menü mit Bild und Text als Overlay. CSS kann angepasst werden.

weitere Bootstrap 4 Overrides zu finden auf https://github.com/webconcept-desing
