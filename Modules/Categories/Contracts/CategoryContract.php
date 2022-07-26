<?php
namespace Modules\Categories\Contracts;

interface CategoryContract
{

    public function listCategories(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findCategoryById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createCategory(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateCategory(array $params,int $id);

    /**
     * @param $id
     * @return bool
     */

    public function deleteCategory($id);
    /**
     * @return mixed
     */
    public function treeList();

    /**
    * @param $slug
    * @return mixed
    */
    public function findBySlug($slug);
}
