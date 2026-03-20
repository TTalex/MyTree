<p align="center">
<img src ="MyTreeLogo.png" alt="MyTreeLogo"/>
</p>

## Introduction
MyTree uses an extract from OpenStreetMap database to retrieve planting dates of trees in europe, a list of trees planted near your birth date is then generated and displayed on a leaflet map.

## Running it
1. Make sure php is installed on your machine, as well as the sqlite3 extension (installed with `apt install php-sqlite3` on Debian/Ubuntu)
2. Move to your public web folder

```bash
cd /var/www/
```

3. Clone the repo

```bash
git clone https://github.com/TTalex/MyTree.git
```

4. Download the database from github releases

```bash
wget https://github.com/TTalex/MyTree/releases/download/v1.0/trees.db
```

5. Access [http://localhost/MyTree](http://localhost/MyTree)

## Generating the database
1. Download an OSM europe dump using https://download.geofabrik.de/europe.html
2. Use osmium to filter the data, keeping only nodes with a tag `start_date` and tag `natural=tree`

```bash
osmium tags-filter europe-latest.osm.pbf n/start_date -o filtered_sd_eu.pbf
osmium tags-filter filtered_sd_eu.pbf n/natural=tree -o filtered_eu.pbf
```

3. Convert the resulting pbf file to a sqlite database, for example using [pbf2sqlite](https://github.com/osmzoso/pbf2sqlite)

```bash
wget https://github.com/osmzoso/pbf2sqlite/releases/download/v0.5/pbf2sqlite
chmod +x pbf2sqlite
./pbf2sqlite filtered_eu.pbf trees.db
```
