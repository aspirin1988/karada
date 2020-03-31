<?php

namespace App;


use Redis;

class RedisData_
{

    public $topList = [
        'day' => 60 * 60 * 24,
        'week' => 60 * 60 * 24 * 7,
        'month' => 60 * 60 * 24 * 30,
    ];

    protected $redis;

    public function __construct($table)
    {
        $host = '127.0.0.1';
        $port = 6379;
        $database = 0;
        $password = 'wWscefXpK1TITwlMgSVu0cZ5zQuRC3vbaofNnsTiqQ2CP2mWVARBBx2w5AaxGdlo';

        $this->setTable($table);
        $this->redis = new \Redis();
        try {
            $this->redis->connect($host, $port);
        } catch (Exception $e) {
            $this->con_ = null;
            return null;
        }

        $this->redis->auth($password);
        $this->redis->select($database);
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    public function getAllKey($pattern = ':*')
    {
        return $this->redis->keys($this->table . $pattern);
    }


    public function getKey($type, $id)
    {
        $key = $type . ':' . $id;
        $key = trim($key, ':');
        $value = $this->redis->get($this->table . ':' . $key);

        return (int)$value;
    }

    public function getKeyRaw($type, $id)
    {
        $key = $type . ':' . $id;
        $key = trim($key, ':');
        $value = $this->redis->get($this->table . ':' . $key);

        return $value;
    }


    public function getKeys($type, $ids)
    {
        $result = [];

        foreach ($ids as $key => $value) {
            $key = $type . ':' . $value;

            $result[] = $this->table . ':' . $key;
        }

        $cache_val = $this->redis->mget($result);

        foreach ($cache_val as $key => $value) {

            $cache_val[$key] = (int)$value;
        }

        return array_combine($ids, $cache_val);
    }


    public function setKey($value, $type, $id)
    {
        $key = $type . ':' . $id;
        $this->redis->set($this->table . ':' . $key, $value);

        return (int)$this->redis->get($this->table . ':' . $key);
    }

    public function setKeyRaw($value, $type, $id)
    {
        $key = $type . ':' . $id;

        return $this->redis->set($this->table . ':' . $key, $value);
    }

    public function incKey($type, $id)
    {
        $key = $type . ':' . $id;
        if (!$this->redis->exists($key)) {
            $this->addToList($type, $id, $key);
        }
        $value = $this->redis->incr($this->table . ':' . $key);

        $this->menuAddParent();
        $this->menuAddItem($type);

        return (int)$value;
    }

    public function addToList($type, $id, $key)
    {
        foreach ($this->topList as $item => $value) {

            $this->redis->setex($this->table . ':' . $item . ":" . $key, $value, json_encode(['type' => $type, 'id' => $id, 'key' => $key]));

        }
    }

    public function updateDayRating($type = 'news', $limit = 3)
    {
        $prefix = Yii::t('site', 'prefix');
        $key = "top_news_day" . $prefix;

        $data = Cache::get($key);


        if ($data) {

            $result = $data;

        } else {

            $result = [];

            if ($data = $this->redis->keys($this->table . ":day:{$type}:*")) {

                $data = $this->redis->mget($data);

                $data = array_slice($data, 0, 2000);

                foreach ($data as $item => $value) {
                    $data[$item] = json_decode($value);
                    $result[$data[$item]->id] = ['views' => (int)$this->redis->get($this->table . ':' . $data[$item]->key), "id" => $data[$item]->id, "type" => $data[$item]->type];
                }

                arsort($result);
                $result = array_values($result);
                $result = array_slice($result, 0, $limit);

                $day = [];
                foreach ($result as $key => $value) {
                    $day[] = $value['id'];
                }
                $result = $day;

                Cache::set($key, $result, 60 * 60 * 1);

            }
        }

        return $result;
    }

    public function updateWeekRating($type = 'news', $limit = 3, $exclude = [])
    {
        $prefix = Yii::t('site', 'prefix');
        $key = "top_news_week" . $prefix;

        $data = Cache::get($key);

        if ($data) {

            $result = $data;

        } else {

            $result = [];

            if ($data = $this->redis->keys($this->table . ":week:{$type}:*")) {

                $data = $this->redis->mget($data);

                $data = array_slice($data, 0, 2000);

                foreach ($data as $item => $value) {
                    $data[$item] = json_decode($value);
                    if (!in_array($data[$item]->id, $exclude)) {
                        $result[$data[$item]->id] = ['views' => (int)$this->redis->get($this->table . ':' . $data[$item]->key), "id" => $data[$item]->id, "type" => $data[$item]->type];
                    }
                }

                $result = array_values($result);
                $result = array_slice($result, 0, $limit);

                $week = [];
                foreach ($result as $key => $value) {
                    $week[] = $value['id'];
                }
                $result = $week;

                Cache::set($key, $result, 60 * 60 * 24 * 1);

            }

        }

        return $result;
    }

    public function updateMonthRating($type = 'news', $limit = 3, $exclude = [])
    {
        $prefix = Yii::t('site', 'prefix');
        $key = "top_news_month" . $prefix;

        $data = Cache::get($key);

        if ($data) {

            $result = $data;

        } else {

            $result = [];

            if ($data = $this->redis->keys($this->table . ":month:{$type}:*")) {

                $data = $this->redis->mget($data);

                $data = array_slice($data, 0, 2000);

                foreach ($data as $item => $value) {
                    $data[$item] = json_decode($value);
                    if (!in_array($data[$item]->id, $exclude)) {
                        $result[$data[$item]->id] = ['views' => (int)$this->redis->get($this->table . ':' . $data[$item]->key), "id" => $data[$item]->id, "type" => $data[$item]->type];
                    }
                }

                arsort($result);
                $result = array_values($result);
                $result = array_slice($result, 0, $limit);

                $month = [];
                foreach ($result as $key => $value) {
                    $month[] = $value['id'];
                }
                $result = $month;

                Cache::set($key, $result, 60 * 60 * 24 * 7);

            }
        }

        return $result;
    }

    public function menuAddParent()
    {
        $menu = $this->redis->get('menu');
        if ($menu) {
            $menu = json_decode($menu, true);
        } else {
            $menu = [];
        }

        $isset = false;
        foreach ($menu as $key => $value) {
            if ($key == $this->table) {
                $isset = true;
            }
        }
        if (!$isset) {
            $menu[$this->table] = ['day' => [], 'week' => [], 'month' => []];
        }
        $menu = json_encode($menu);
        $this->redis->set('menu', $menu);
    }

    public function menuAddItem($type)
    {
        $menu = $this->redis->get('menu');
        $menu = json_decode($menu, true);
        $table = $menu[$this->table];
        if (!in_array($type, $table)) {
            $table[] = $type;
        }
        if (!in_array($type, $table['day'])) {
            $table['day'][] = $type;
        }
        if (!in_array($type, $table['week'])) {
            $table['week'][] = $type;
        }
        if (!in_array($type, $table['month'])) {
            $table['month'][] = $type;
        }
        $menu[$this->table] = $table;
        $menu = json_encode($menu);
        $this->redis->set('menu', $menu);
    }

}
