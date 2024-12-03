<?php
declare(strict_types=1);

namespace App\Controller;

use Mailgun\Mailgun;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Users->find();
        $users = $this->paginate($query);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function login()
    {
        $result = $this->Authentication->getResult();
        // If the user is logged in send them away.
        if ($result->isValid()) {
            $target = $this->Authentication->getLoginRedirect() ?? '/';
            return $this->redirect($target);
        }
        if ($this->request->is('post')) {
            $this->Flash->error('Invalid username or password');
        }
    }

    public function logout()
    {
        $this->Authentication->logout();
        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }   

    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $email = trim($this->request->getData('email')); // Récupérer et nettoyer l'email

            // Vérifier si l'email est vide
            if (empty($email)) {
                $this->Flash->error('Veuillez entrer une adresse email.');
                return;
            }

            // Rechercher l'utilisateur
            $user = $this->Users->findByEmail($email)->first();

            if (!$user) {
                $this->Flash->error('Aucun utilisateur trouvé avec cette adresse email.');
                return;
            }

            // Générer un nouveau mot de passe
            $newPassword = bin2hex(random_bytes(4)); // Exemple : 8 caractères
            $user->password = $newPassword;

            if ($this->Users->save($user)) {
                // Configurer Mailgun
                $apiKey = env('MAILGUN_API_KEY');
                $domain = env('MAILGUN_DOMAIN');

                if (!$apiKey || !$domain) {
                    $this->Flash->error('Configuration Mailgun manquante.');
                    return;
                }

                $mgClient = Mailgun::create($apiKey); // Instanciation du client Mailgun

                // Préparer l'email
                $params = [
                    'from' => 'noreply@' . $domain,
                    'to' => $email,
                    'subject' => 'Votre nouveau mot de passe',
                    'text' => "Bonjour,\n\nVotre nouveau mot de passe est : $newPassword\n\nMerci."
                ];

                try {
                    $mgClient->messages()->send($domain, $params); // Envoi de l'email
                    $this->Flash->success('Un nouveau mot de passe a été envoyé à votre adresse email.');
                } catch (\Exception $e) {
                    $this->Flash->error('Erreur lors de l\'envoi de l\'email : ' . $e->getMessage());
                }
            } else {
                $this->Flash->error('Impossible de mettre à jour le mot de passe. Veuillez réessayer.');
            }
        }
        $this->render('forgot-password');
    }
}
