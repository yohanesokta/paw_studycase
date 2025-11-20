<?php
class Middleware
{
    private function admin(array $userdata) {
        if ($userdata['role'] != "admin") {
            return Redirect("/");
        }
    }

    private function users(array $userdata) {
        if ($userdata['role'] != "pelanggan") {
            return Redirect("/");
        }
    }

    public function handle($role)
    {
        session_start();
        if (isset($_SESSION['userdata'])) {
            switch ($role) {
                case 'admin':
                    $this->admin($_SESSION['userdata']);
                    break;
                case "pelanggan" :
                    $this->users($_SESSION["userdata"]);
                    break;
            }
        } else {
            Redirect("/");
        }
    }
}
