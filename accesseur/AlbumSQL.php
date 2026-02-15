<?php
interface AlbumSQL
{
    public const SQL_LISTE_ALBUM = "
    	SELECT 
			album.id,
    	    album.nom, 
    	    album.artiste, 
    	    album.type, 
    	    album.date_sortie, 
    	    album.fichier_image, 
    	    SEC_TO_TIME(SUM(TIME_TO_SEC(morceau.duree))) AS duree
    	FROM album
    	LEFT JOIN morceau ON album.id = morceau.id_album
    	GROUP BY album.id, album.nom, album.artiste, album.type, album.date_sortie, album.fichier_image
	";

    public const SQL_DETAIL_ALBUM = "
		SELECT 
			album.id,
    		album.nom, 
    		album.artiste, 
    		album.type, 
    		album.date_sortie, 
    		album.fichier_image, 
    		SEC_TO_TIME(SUM(TIME_TO_SEC(morceau.duree))) AS duree
		FROM album
		LEFT JOIN morceau ON album.id = morceau.id_album
		WHERE album.id = :id
		GROUP BY album.id
	";

	public const SQL_RECHERCHER_ALBUM_MORCEAU = "
        (
            SELECT
				id,
                nom, 
                artiste,
                fichier_image,
				YEAR(date_sortie) as annee,
				type
            FROM album
            WHERE nom LIKE :recherche OR artiste LIKE :recherche OR date_sortie LIKE :recherche
        )
        UNION
        (
            SELECT 
				morceau.id as id,
                morceau.titre AS nom,
                morceau.artiste AS artiste,
                album.fichier_image,
                YEAR(album.date_sortie) as annee,
				null as type
            FROM morceau JOIN album ON morceau.id_album = album.id
            WHERE morceau.titre LIKE :recherche OR morceau.artiste LIKE :recherche OR album.date_sortie LIKE :recherche
        )
		ORDER BY type DESC, nom
        LIMIT 10
    ";
}
?>