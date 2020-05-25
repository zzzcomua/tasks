<?php


namespace Tasks\Controller;


use Exception;
use Tasks\Helper\SessionHelper;
use Tasks\Model\Alert;

abstract class BaseController
{
    /**
     * @var SessionHelper
     */
    protected $session;

    public function __construct()
    {
        $this->session = SessionHelper::getInstance();
    }

    /**
     * @return string|null
     * @throws Exception
     */
    abstract public function execute(): ?string;

    /**
     * @return string|null
     */
    public function executeWithLayout(): ?string
    {
        try {
            $content = $this->execute();
        } catch (Exception $e) {
            $this->addAlertError($e->getMessage());
        }

        if (empty($content)) {
            return null;
        }

        return $this->render('layout', [
            'content' => $content,
            'errors' => $this->getAlerts(Alert::KEY_ERROR),
            'infos' => $this->getAlerts(Alert::KEY_INFO),
            'isLogIn' => $this->session->isLogIn(),
        ]);
    }

    /**
     * @param string $text
     */
    public function addAlertInfo(string $text): void
    {
        $this->addAlert(Alert::KEY_INFO, $text);
    }

    /**
     * @param string $text
     */
    public function addAlertError(string $text): void
    {
        $this->addAlert(Alert::KEY_ERROR, $text);
    }

    /**
     * @param callable $function
     * @param string|null $successMessage
     * @return bool
     */
    protected function handlePost(callable $function, string $successMessage = null): bool
    {
        if (empty($_POST)) {
            return false;
        }

        try {
            $success = $function();
        } catch (Exception $e) {
            $success = false;
            $this->addAlertError($e->getMessage());
        }

        if ($success && $successMessage) {
            $this->addAlertInfo($successMessage);
        }

        return $success;
    }


    /**
     * @param string $key
     * @param string $text
     */
    protected function addAlert(string $key, string $text): void
    {
        $alerts = $this->session->getValue($key, []);

        $alerts[] = $text;

        $this->session->setValue($key, $alerts);
    }

    /**
     * @param string $key
     *
     * @return string[][]
     */
    protected function getAlerts(string $key): array
    {
        $alerts = $this->session->getValue($key, []);

        $this->session->unsetValue($key);

        return $alerts;
    }

    /**
     * @param string $template
     * @param array $variables
     *
     * @return string|null
     */
    protected function render(string $template, array $variables): ?string
    {
        extract($variables);

        ob_start();

        include 'views/' . $template . '.php';

        return ob_get_clean();
    }

    protected function redirectIndex(): void
    {
        header('Location: /');
    }

    /**
     * @param string $action
     */
    protected function redirect(string $action): void
    {
        header('Location: /?action=' . $action);
    }

    protected function validatePostField(
        $value,
        string $name,
        string $type = null,
        bool $required = true
    ): bool
    {
        if ($required && empty($value)) {
            $this->addAlertError('Field ' . $name . ' required.');
            return false;
        }

        switch ($type) {
            case FILTER_VALIDATE_EMAIL:
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addAlertError('Field ' . $name . ' mast be email.');

                    return false;
                }
                break;
            case FILTER_VALIDATE_INT:
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                    $this->addAlertError('Field ' . $name . ' mast be number.');

                    return false;
                }
                break;
            case null:
                return true;
                break;
            default:
                $this->addAlertError('Unknown type ' . $type . '.');
                return false;
        }

        return true;
    }
}