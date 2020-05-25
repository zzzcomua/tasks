<?php


namespace Tasks\Controller;


use Tasks\Model\Task;

class IndexController extends BaseController
{
    protected const PER_PAGE = 3;

    /**
     * @inheritDoc
     */
    public function execute(): ?string
    {
        $sortField = $this->getListedParam(Task::KEY_SORT_FIELD, Task::SORT_FIELDS);
        $sortOrder = $this->getListedParam(Task::KEY_SORT_ORDER, Task::SORT_ORDER, 'desc');
        $page = (int)($_GET['page'] ?? 1);

        $query = Task::skip(($page-1) * self::PER_PAGE)
            ->limit(self::PER_PAGE);

        if (!empty($sortField)) {
            $query->orderBy($sortField, $sortOrder);
        }

        if ($sortField !== 'name') {
            // для выполнениея в пункте 6 условия
            // "Имя пользователя, которое было последним в списке, должно стать первым"
            $query->orderBy('id', $sortOrder);
        }

        $tasks = $query->get();

        $totalPages = ceil(Task::count() / self::PER_PAGE);

        $sortFieldsList = $this->getSortList(Task::KEY_SORT_FIELD, Task::SORT_FIELDS);
        $sortOrderList = $this->getSortList(Task::KEY_SORT_ORDER, Task::SORT_ORDER);

        return $this->render('index', [
            'tasks' => $tasks,
            'sortFieldsList' => $sortFieldsList,
            'sortOrderList' => $sortOrderList,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'isLogIn' => $this->session->isLogIn(),
        ]);
    }

    /**
     * @param string $param
     * @param mixed[] $allowed
     * @param mixed $default
     * @return mixed
     */
    private function getListedParam(string $param, array $allowed, $default = null)
    {
        $result = $_GET[$param] ?? $default;

        if (in_array($result, $allowed)) {
            return $result;
        }

        return $default;
    }

    /**
     * @param string $key
     * @param array $values
     *
     * @return string[]
     */
    private function getSortList(string $key, array $values): array
    {
        $result = [];

        foreach ($values as $value) {
            $result[$value] = '/?' . $this->replaceGetParam($key, $value);
        }

        return $result;
    }

    /**
     * @param string $param
     * @param string $value
     *
     * @return string
     */
    protected function replaceGetParam(string $param, string $value): string
    {
        $query = $_GET;
        $query[$param] = $value;

        return http_build_query($query);
    }
}