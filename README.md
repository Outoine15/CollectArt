# CollectArt

Créer des toiles (pixel art) numérique vides et les modifier soit tous seul soit avec d'autres personnes, ainsi que voter pour les meilleurs d'entres elles.

Les toiles en mode défis permettent de s'ammuser à immiter des images si l'on manqe d'inspiration pour commencer de zéro.

## base de données

```mermaid
classDiagram
    USER --|> TOILE
    TOILE --|> TOILE_DEFIS
    TOILE --|> TOILE_NOTES
    TOILE --|> TOILE_TAGS
    TOILE --|> TOILE_PARTICIPANTS
    USER --|> TOILE_PARTICIPANTS
    class ADMIN{
        ID 'int' AI 11
        NAME 'char' 16
        PWD 'char' 100
    }
    class USER{
        ID 'int' AI 11
        NAME 'char' 16
        PWD 'char' 100
    }
    class TOILE{
        ID 'int' AI 11
        NAME 'char' 16
        DESCRIPTION 'char' 200
        ID_CREATOR 'int' 11
    }
    class TOILE_TAGS{
        ID 'int' 11
        ID_TOILE 'int' 11
        TAG 'chr' 16
    }
    class TOILE_PARTICIPANTS{
        ID 'int' 11
        ID_TOILE 'int' 11
        ID_USER 'int' 11
    }
    class TOILE_NOTES{
        ID 'int' 11
        ID_TOILE 'int' 11
        ID_USER 'int' 11
        NOTE 'int'
    }
    class TOILE_DEFIS{
        ID_TOILE 'int' 11
        IMG_FILE 'chr' 100
    }

```

[![wakatime](https://wakatime.com/badge/github/Outoine15/CollectArt.svg)](https://wakatime.com/badge/github/Outoine15/CollectArt)

## auteurs (groupe 5):

Titouan, Ludovic, Christer, Nathan

L1 MISPI, 2024-2025
