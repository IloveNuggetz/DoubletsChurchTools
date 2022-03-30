<?php

namespace App\Model;

interface MergeableInterface
{
    public function getVarsToMerge();

    public function setMergedVars($mergedVarsMap);
}
