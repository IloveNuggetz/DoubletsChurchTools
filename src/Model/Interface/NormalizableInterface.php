<?php

namespace App\Model;

interface NormalizableInterface
{
    public function getVarsToNormalize();

    public function setNormalizedVars($normalizedVarsMap);
}
