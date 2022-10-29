@foreach($passing as $fieldName => $fieldData)
    <?php
        $fieldValue = isset($data->$fieldName) ? $data->$fieldName : null;
        if ($fieldData['type'] == 'image') {
            if (isset($data->{$fieldName.'_full'})) {
                $fieldValue = $data->{$fieldName.'_full'};
            }
            else if (strlen($fieldValue) > 0) {
                $fieldValue = asset($fieldValue);
            }
            else {
                $fieldValue = asset('assets/cms/images/no-img.png');
            }
        }

        $listPassing = [
            'fieldName' => $fieldName,
            'fieldLang' => __($fieldData['lang']),
            'fieldRequired' => isset($fieldData['validate'][$viewType]) && in_array('required', explode('|', $fieldData['validate'][$viewType])) ? 1 : 0,
            'fieldValue' => $fieldValue,
            'fieldMessage'=>$fieldData['message'],
            'path'=>$fieldData['path'],
            'addAttribute'=>$addAttribute,
            'fieldExtra' => isset($fieldData['extra'][$viewType]) ? $fieldData['extra'][$viewType] : [],
            'viewType' => $viewType
        ];

        $arrayPassing = [];
        if (in_array($fieldData['type'], ['select', 'select2', 'tagging', 'multiselect', 'multiselect2'])) {
            $arrayPassing = isset($listSet[$fieldName]) ? $listSet[$fieldName] : [];
        }
        else if(in_array($fieldData['type'], ['file', 'file_many', 'image', 'image_many'])) {
            if(in_array($viewType, ['edit', 'create'])) {
//                $listPassing['fieldMessage'] = 'Max Upload file adalah 2Mb';
            }
        }
        $listPassing['listFieldName'] = $arrayPassing;
    ?>
    @component(env('ADMIN_TEMPLATE').'._component.form.'.$fieldData['type'], $listPassing)
    @endcomponent
@endforeach
