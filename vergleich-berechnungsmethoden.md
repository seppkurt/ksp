# Vergleich der Berechnungsmethoden für den Körperschwerpunkt

Dieses Dokument vergleicht die beiden Methoden zur Berechnung des Körperschwerpunkts (KSP) aus markierten Körperpunkten.

---

## Übersicht

| Aspekt | Methode 1: Vereinfacht (Joint-basiert) | Methode 2: Original (Segment-basiert) |
|--------|----------------------------------------|--------------------------------------|
| **Eingabepunkte** | 17 Gelenke/Landmarken | 17 Gelenke/Landmarken |
| **Verwendete Punkte** | Gelenke direkt mit Gewichten | Berechnete Segmentzentren (TKSP) |
| **Gewichtssumme** | 108 (65 + 43 Torso) | 100 |
| **Ergebnis** | Abweichend | Anatomisch korrekt |

---

## Methode 1: Vereinfachte Berechnung (Joint-basiert)

### Prinzip
Die markierten Gelenkpunkte werden **direkt** als gewichtete Punkte verwendet. Jeder Punkt erhält ein Gewicht entsprechend dem Körperteil, zu dem er gehört.

### Gewichte der Gelenkpunkte

| Punkt | Körperteil | Gewicht |
|-------|------------|---------|
| 1 | Linke Fußspitze | 2,0 |
| 2 | Linkes Knöchel | 2,0 |
| 3 | Linkes Knie | 5,0 |
| 4 | Linke Hüfte | 12,0 |
| 5 | Rechte Hüfte | 12,0 |
| 6 | Rechtes Knie | 5,0 |
| 7 | Rechtes Knöchel | 2,0 |
| 8 | Rechte Fußspitze | 2,0 |
| 9 | Rechte Handspitze | 1,0 |
| 10 | Rechtes Handgelenk | 1,0 |
| 11 | Rechter Ellenbogen | 2,0 |
| 12 | Rechte Schulter | 3,0 |
| 13 | Linke Schulter | 3,0 |
| 14 | Linker Ellenbogen | 2,0 |
| 15 | Linkes Handgelenk | 1,0 |
| 16 | Linke Handspitze | 1,0 |
| 17 | Kopf | 7,0 |
| — | **Rumpf (berechnet)** | **43,0** |
| | **Summe** | **108,0** |

### Formel
```
KSP_x = Σ(Punkt_x × Gewicht) / Σ(Gewicht)
KSP_y = Σ(Punkt_y × Gewicht) / Σ(Gewicht)
```

### Nachteil
Gelenke sind **keine** Massenschwerpunkte. Der Massenschwerpunkt eines Segments (z.B. Oberschenkel) liegt zwischen den Gelenken, nicht an den Gelenken selbst. Die Vereinfachung führt zu weniger genauen Ergebnissen.

---

## Methode 2: Original-Berechnung (Segment-basiert)

### Prinzip
Aus den 17 Gelenkpunkten werden zunächst die **Teilschwerpunkte (TKSP)** der 14 Körpersegmente berechnet. Diese Segmentzentren repräsentieren die tatsächlichen Massenschwerpunkte der Körperteile. Anschließend wird der Gesamt-KSP als gewichteter Mittelwert dieser Segmentzentren berechnet.

### Berechnung der Segmentzentren (TKSP)

Die Formel `new_vektor(Start, Ende, VFaktor)` berechnet einen Punkt auf der Linie zwischen Start und Ende:
```
Punkt = (1 - VFaktor) × Ende + VFaktor × Start
```

| Segment | Von → Bis | VFaktor | Beschreibung |
|---------|-----------|---------|--------------|
| Rechter Fuß | Knöchel → Fußspitze | 0,44 | 44 % vom Knöchel zur Spitze |
| Rechtes Unterschenkel | Knöchel → Knie | 0,42 | 42 % vom Knöchel zum Knie |
| Rechter Oberschenkel | Knie → Hüfte | 0,44 | 44 % vom Knie zur Hüfte |
| Linker Oberschenkel | Knie → Hüfte | 0,44 | 44 % vom Knie zur Hüfte |
| Linkes Unterschenkel | Knie → Knöchel | 0,42 | 42 % vom Knie zum Knöchel |
| Linker Fuß | Knöchel → Fußspitze | 0,44 | 44 % vom Knöchel zur Spitze |
| Rechte Hand | Handgelenk → Handspitze | 0,50 | Mitte (50 %) |
| Rechter Unterarm | Ellenbogen → Handgelenk | 0,42 | 42 % vom Ellenbogen |
| Rechter Oberarm | Schulter → Ellenbogen | 0,47 | 47 % von der Schulter |
| Linker Oberarm | Schulter → Ellenbogen | 0,47 | 47 % von der Schulter |
| Linker Unterarm | Ellenbogen → Handgelenk | 0,42 | 42 % vom Ellenbogen |
| Linke Hand | Handgelenk → Handspitze | 0,50 | Mitte (50 %) |
| Rumpf | Hüftmitte → Schultermitte | 0,44 | 44 % von der Hüftmitte |
| Kopf | — | — | Direkt (Kopfpunkt) |

### Gewichte der Segmentzentren (Summe = 100)

| Segment | Gewicht | Anteil |
|---------|---------|--------|
| Kopf | 7 | 7 % |
| Rumpf | 43 | 43 % |
| Rechter Oberarm | 3 | 3 % |
| Linker Oberarm | 3 | 3 % |
| Rechter Unterarm | 2 | 2 % |
| Linker Unterarm | 2 | 2 % |
| Rechte Hand | 1 | 1 % |
| Linke Hand | 1 | 1 % |
| Rechter Oberschenkel | 12 | 12 % |
| Linker Oberschenkel | 12 | 12 % |
| Rechtes Unterschenkel | 5 | 5 % |
| Linkes Unterschenkel | 5 | 5 % |
| Rechter Fuß | 2 | 2 % |
| Linker Fuß | 2 | 2 % |
| **Summe** | **100** | **100 %** |

### Formel (Original berechne.php)
```
KSP_x = (kopf×7 + rumpf×43 + oarmre×3 + oarmli×3 + uarmre×2 + uarmli×2 
         + handre×1 + handli×1 + obersre×12 + obersli×12 
         + untersre×5 + untersli×5 + fussre×2 + fussli×2) / 100
```

---

## Vergleich der Ergebnisse

| Kriterium | Methode 1 (Vereinfacht) | Methode 2 (Original) |
|-----------|-------------------------|----------------------|
| **Anatomische Korrektheit** | Geringer – Gelenke ≠ Massenschwerpunkte | Höher – Segmentzentren entsprechen Massenschwerpunkten |
| **Berechnungsaufwand** | Einfacher – Direkte Gewichtung | Höher – Zwei Schritte (TKSP → KSP) |
| **Gewichtssumme** | 108 (Normierung nötig) | 100 (Prozentanteile) |
| **Gewichtsanpassung** | Möglich pro Punkt | Fest – Anatomische Standardwerte |
| **Verwendung** | Schnelle Näherung | Wissenschaftliche/medizinische Anwendung |

---

## Zusammenfassung

Die **Original-Methode (Segment-basiert)** ist die empfohlene Berechnungsweise, da sie:

1. **Anatomisch fundiert** ist – die VFaktor-Werte basieren auf Segmentanalysen
2. **Segmentzentren** verwendet statt Gelenkpositionen
3. **Standardisierte Gewichte** nutzt (z.B. 43 % Rumpf, 7 % Kopf)
4. **Mit der ursprünglichen PHP-Implementierung** übereinstimmt

Die aktuelle Implementierung in `center-of-mass.html` und `center-of-mass-de.html` verwendet die **Original-Methode (Segment-basiert)**.
