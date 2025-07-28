<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                Bienvenue Admin 👋
            </div>
        </div>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit" class="text-red-600 hover:underline">
            Déconnexion admin
        </button>
    </form>
    <!-- moi j'ai creer un projet avec laravel breeze sur la gestion des cotisations j'ai fait tout les choses a faire pour les login et register et tous les autres choses maintenat je veux une admin dashborad avce un design plus modern qui gere les cotisations et les depenses et touot les autres choses  -->
</body>
</html>