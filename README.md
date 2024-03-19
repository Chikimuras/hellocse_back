Pour installer le projet, il suffit de cloner le dépôt. Le projet utilise Laravel Sail pour la gestion des conteneurs Docker. Pour installer le projet, il suffit de lancer la commande suivante:
```bash
git clone
cd
docker run --rm --interactive --tty -v $(pwd):/app composer install
cp .env.example .env
./vendor/bin/sail up
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

##Lancer le projet front-end
Pour lancer le projet front-end, il suffit de lancer les commandes suivantes :
```bash
npm install
npm run dev
```

## Création d'un utilisateur
Pour créer un utilisateur, il suffit de lancer la commande suivante:
```bash
./vendor/bin/sail artisan tinker
```
```
use App\Models\User;
$user = new User;
$user->name = 'John Doe';
$user->email = 'john@doe.com';
$user->password = bcrypt('password');
$user->save();
```
Vous pouvez maintenant vous connecter avec l'utilisateur john@doe.com et le mot de passe password.
