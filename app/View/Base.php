<?php 

    namespace app\View;

    Class Base 
    {
        private function head() {

            $html = '
                <title>' . $this->model->getPage() . ' - Bee Active</title>

                <link rel="stylesheet" href="public/css/Shared.css" />
                <link rel="stylesheet" href="public/css/' . $this->model->getPage() . '.css" />

                <script src="public/js/Shared.js"></script>
                <script src="public/js/' . $this->model->getPage() . '.js"></script>
            ';

            return $html;
        }

        private function nav() {

            $user = $this->model->getUser();

            $html = '
                <nav>
                    <ul>
                        <li>
                            <a href="?p=Home">Home</a>
                        </li>
            ';

            if ( $user ) {
                $html .= '
                        <li>
                            <a href="?p=Workouts">Workouts</a>
                        </li>
                        <li>
                            <a href="?p=Macros">Macros</a>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <a href="?p=Profile">Profile</a>
                        </li>
                        <li>
                            <a href="?p=Logout">Logout</a>
                        </li>
                    </ul>
                ';
            } else {
                $html .= '
                    </ul>

                    <ul>
                        <li>
                            <a href="?p=Login">Login</a>
                        </li>
                        <li>
                            <a href="?p=Register">Register</a>
                        </li>
                    </ul>
                ';
            }                        

            $html .= '
                    </ul>
                </nav>
            ';

            return $html;
        }

        private function footer() {

            $html = '
                footer
            ';

            return $html;
        }

        public function render() {

            $html = '
                <!DOCTYPE html>
                <html lang="en">
                    <head>
                        ' . $this->head() . '
                    </head>
                    <body>
                        <header class="honeycomb shadow">
                            ' . $this->nav() . '
                        </header>

                        <main>
                            ' . $this->content() . '
                        </main>
            
                        <footer class="honeycomb shadow">
                            ' . $this->footer() . '
                        </footer>
                    </body>
                </html>
            ';

            return $html;
        }
    }
