<?php
namespace Modules\Core\Traits;

trait FlashMessages{

    protected $errorMessages = [];

    protected $infoMessages = [];

    protected $successMessages = [];

    protected $warningMessages = [];

    protected function setFlashMessage($message, $type){
        $model = 'infoMessages';

        switch ($type) {
            case 'success':
                $model = 'successMessages';
                break;
            case 'info':
                $model = 'infoMessages';
                break;
            case 'error':
                $model = 'errorMessages';
                break;
            case 'warning':
                $model = 'warningMessages';
                break;
        }

        if (is_array($message)) {
            foreach ($message as $key => $value) {
                array_push($this->$model, $value);
            }
        }

        array_push($this->$model, $message);

    }

    protected function getFlashMessage(){
        return [
            'info' => $this->infoMessages,
            'error' => $this->errorMessages,
            'success' => $this->successMessages,
            'warning' => $this->warningMessages,
        ];
    }

    protected function showFlashMessage(){
        session()->flash('info',$this->infoMessages);
        session()->flash('error',$this->errorMessages);
        session()->flash('success',$this->successMessages);
        session()->flash('warning',$this->warningMessages);
    }
}
