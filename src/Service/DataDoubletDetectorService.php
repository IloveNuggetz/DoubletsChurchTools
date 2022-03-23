<?php

namespace App\Service;

class DataDoubletDetectorService
{
    public function detectDoublets($objectsDataSet, $rulesToApply)
    {
        foreach ($objectsDataSet as $objectData) {
            $objectVarsMap = $objectData->getObjectVars();

            foreach ($objectVarsMap as $objectVar => $objectVarVal) {
                $objectVarsMap[$objectVar] = $objectVarVal;
            }
            $objectData->setObjectVars($objectVarsMap);
        }
    }
}
