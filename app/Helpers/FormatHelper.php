<?php
function formatJenis($jenis)
{
    return ucwords(str_replace('_', ' ', $jenis));
}
