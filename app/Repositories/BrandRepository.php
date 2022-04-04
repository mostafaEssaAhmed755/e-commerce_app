<?php

namespace App\Repositories;

use App\Contracts\BrandContract;
use App\Models\Brand;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Doctrine\Instantiator\Exception\InvalidArgumentExcepti;
use App\Traits\UploadAble;
use Illuminate\Http\UploadedFile;

class BrandRepository extends BaseRepository implements BrandContract
{
    use UploadAble;

    public function __construct(Brand $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listBrands(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all($columns,$order,$sort);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findBrandById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new ModelNotFoundException($exception);
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function createBrand(array $params)
    {
        try {
            $collection = collect($params);

            $logo = null;

            if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'] , 'brands');
            }

            $merge = $collection->merge(compact('logo'));

            $brand = new Brand($merge->all());

            $brand->save();

            return $brand;
        } catch (QueryException $exception) {
            throw new InvalidArgumentException($exception->getMessage());
        }
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function updateBrand(array $params, int $id)
    {
        $brand = $this->findBrandById($id);

        $collection = collect($params)->except('_token');
        $merge = $collection;

        if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
            if ($brand->logo != null) {
                $this->deleteOne($brand->logo);
            }

            $logo = $this->uploadOne($params['logo'] , 'brands');
            $merge = $collection->merge(compact('logo'));
        }

        $brand->update($merge->all());

        $brand->save();

        return $brand;

    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteBrand($id)
    {
        $brand = $this->findBrandById($id);

        if ($brand->logo != null) {
             $this->deleteOne($brand->logo);
        }

        $brand->delete();

        return $brand;
    }

}
