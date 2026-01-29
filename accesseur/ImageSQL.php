<?php
interface ImageSQL
{
    public const SQL_IMAGE_ALBUM = "SELECT id FROM image JOIN album ON image.id = album.id_image WHERE album.id = :id";
}
?>