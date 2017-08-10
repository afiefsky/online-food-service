<?php

namespace OFS\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class AbstractRepository
 * @package OFS\Repositories
 */
abstract class AbstractRepository extends BaseRepository
{

    /**
     * @var Model
     */
    protected $baseModel;

    /**
     * AbstractRepository constructor.
     *
     * @param Application $app
     * @param Model       $model
     */
    public function __construct(Application $app, Model $model)
    {
        $this->baseModel = $model;
        parent::__construct($app);
    }

    /**
     * @return string
     */
    public function model()
    {
        return get_class($this->baseModel);
    }


	/**
	 * Boot up the repository, pushing criteria
	 */
	public function boot()
	{
		$this->pushCriteria(app(RequestCriteria::class));
	}

	/**
     * Add a basic where clause to the query.
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  mixed   $value
     *
     * @return AbstractRepository
     */
    public function where($column, $operator = null, $value = null)
    {
        $this->model = $this->model->where($column, $operator, $value);
        return $this;
    }

    public function andWhere($column, $operator = null, $value = null)
    {
        $this->model = $this->model->where($column, $operator, $value);
        return $this;
    }

    /**
     * Add an "or where" clause to the query.
     *
     * @param  string  $column
     * @param  string  $operator
     * @param  mixed   $value
     *
     * @return AbstractRepository
     */
    public function orWhere($column, $operator = null, $value = null)
    {
        $this->model = $this->model->orWhere($column, $operator, $value);
        return $this;
    }

    /**
     * @param $sql
     * @param array $bindings
     * @param string $boolean
     * @return $this
     */
    public function whereRaw($sql, $bindings = [], $boolean = 'and')
    {
        $this->model = $this->model->whereRaw($sql, $bindings, $boolean);
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function skip($value)
    {
        $this->model = $this->model->skip($value);
        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function take($value)
    {
        $this->model = $this->model->take($value);
        return $this;
    }

    /**
     * @param null   $limit
     * @param array  $columns
     * @param string $pageName
     *
     * @return mixed
     */
    public function basicPaginate($limit = null, $columns = ['*'], $pageName = 'page')
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->paginate($limit, $columns, $pageName);
        $results->appends(app('request')->query());
        $this->resetModel();

        return $this->parserResult($results);
    }

    /**
     * @param $relation
     * @param $closure
     *
     * @return $this
     */
    public function orWhereHas($relation, $closure)
    {
        $this->model = $this->model->orWhereHas($relation, $closure);

        return $this;
    }
    /**
     * @param $relation
     * @param $closure
     *
     * @return $this
     */
    public function whereHas($relation, $closure)
    {
        $this->model = $this->model->whereHas($relation, $closure);

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function groupBy($column)
    {
        $this->model = $this->model->groupBy($column);

        return $this;
    }
    /**
     * @param $column
     *
     * @return $this
     */
    public function has($column)
    {
        $this->model = $this->model->has($column);

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function min($column)
    {
        $this->model = $this->model->min($column);

        return $this;
    }

    /**
     * @param $column
     *
     * @return $this
     */
    public function max($column)
    {
        $this->model = $this->model->max($column);

        return $this;
    }

    /**
     * @param $key
     * @param $values
     *
     * @return $this
     */
    public function whereIn($key, $values)
    {
        $this->model = $this->model->whereIn($key, $values);

        return $this;
    }

    /**
     * @param $key
     * @param $values
     *
     * @return $this
     */
    public function whereNotIn($key, $values)
    {
        $this->model = $this->model->whereNotIn($key, $values);

        return $this;
    }

    /**
     * @param $model_id
     * @param $relation
     * @param $relation_id
     *
     * @return $this
     */
    public function attach($model_id, $relation, $relation_id)
    {
        $model = $this->model->findOrFail($model_id);
        $model->{$relation}()->attach($relation_id);
        $model->load($relation);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * @param $model_id
     * @param $relation
     * @param $relation_id
     *
     * @return $this
     */
    public function detach($model_id, $relation, $relation_id)
    {
        $model = $this->model->findOrFail($model_id);
        $model->{$relation}()->detach($relation_id);
        $model->load($relation);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * @param $model_id
     * @param $relation
     * @param $relation_id
     *
     * @return $this
     */
    public function syncRel($model_id, $relation, $relation_id)
    {
        $model = $this->model->findOrFail($model_id);
        $model->{$relation}()->sync($relation_id);
        $model->load($relation);
        $this->resetModel();

        return $this->parserResult($model);
    }

    public function trashed($user)
    {
        $model = $this->model->findOrFail($user['id']);

        return $model->trashed();
    }

    public function restore($user)
    {
        $model = $this->model->findOrFail($user['id']);

        return $model->restore();
    }
}
