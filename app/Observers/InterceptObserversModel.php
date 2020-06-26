<?php

    namespace App\Observers;

    use App\Response\Error;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;

    /**
     * Class InterceptObserversModel
     * @package App\Observers
     */
    class InterceptObserversModel
    {

        /**
         * @var Request
         */
        protected $request;

        /**
         * InterceptObserversModel constructor.
         * @param Request|null $request
         */
        public function __construct(Request $request=null)
        {
            $this->request = $request;
        }

        /**
         * @param $model
         * @param $method
         * @return bool|\Illuminate\Http\RedirectResponse|void
         */
        public function validationFields($model, $method)
        {
            $label = $this->request->route()->wheres["label"] ?? "Rota sem o campo Label";
            if(isset($model::$rules[$method]) &&  isset($this->request) && $this->request!=[])
            {
                $rules = [];
                $validator = Validator::make($this->request->all(), $model::$rules[$method]);
                if($validator->fails())
                {
                    return Error::generic($validator->errors(), messageErrors(4000, $label));
                }
            }
            return true;
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function creating(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function created(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function saving(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function saved(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function updating(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function updated(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function retrieved(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function deleting(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function deleted(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function restoring(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

        /**
         * @param $class
         * @return bool|void|Mixed
         */
        public function restored(Model $model)
        {
            return $this->validationFields($model, __FUNCTION__);
        }

    }
