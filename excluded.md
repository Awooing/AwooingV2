## app/config/local.neon

```
parameters:


database:
	dsn: 'mysql:host=databasehost;dbname=databasename'
	user: databaseuser
	password: databasepw

services:
    userRepo: App\Repositories\UserRepository
    councilRepo: App\Repositories\CouncilRepository
    newsRepo: App\Repositories\NewsRepository
    userActions: Awoo\Actions\UserActions
    councilActions: Awoo\Actions\CouncilActions
    newsActions: Awoo\Actions\NewsActions
    cdnRepo: Awoo\Models\CdnRepository
    discordRepo: Awoo\Models\DiscordRepository
    actions: Awoo\Actions\Actions
    authenticator: Awoo\Auth\Authentication
```

## app/Repositories/CdnRepository

```
__construct() {
  $this->cdn = new \SpacesConnect("accesskey", "secretkey", "spacename", "location");
}
```

## app/Repositories/DiscordRepository

```
__construct() {
  $this->token = "discordbottoken";
}
