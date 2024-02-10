# Contribuer à ToDoList

Ce document décrit une utilisation de GitHub pour les contributeurs au projet [ToDoList](https://github.com/Simon-git26/Todo/tree/master).

Voici vos lignes directrices à respecter en tant que contributeurs :

* [Correction de Problèmes](#correction-des-bugs)
* [Demande de fonctionnalité](#nouvelle-fonctionnalité)
* [Guide de soumission](#guide-de-soumission)
* [Règle de Codage](#règle-de-codage)

Je précise que pour n'importe quel action de votre part, en cas de doute, soumettez une [Issue](https://github.com/Simon-git26/Todo/issues).

## Correction des bugs

Vous pouvez soumettre une [Issue](https://github.com/Simon-git26/Todo/issues) au dépôt GitHub si vous trouvez un bug.
Vous pouvez aussi soumettre une [Pull Request](https://github.com/Simon-git26/Todo/pulls) avec un correctif.

## Nouvelle fonctionnalité

Si vous souhaitez proposer ou implémenter une nouvelle fonctionnalité, veuillez soumettre une [Issue](https://github.com/sebAvenel/ToDoList/issues), veuillez la décrire avec le plus de précision possible.

## Guide de soumission

* Pour la correction d'un bug, vous pouvez créer une branche nommée, par exemple `fixBug`, pour la soumission d'une nouvelle fonctionnalitée, vous pouvez créer une branche nommée `new_feature`.

### Soumettre une Issue

Lorsque que vous soumettez une issue, veuillez fournir le plus de précisions possible, ainsi qu'un cas d'utilisation précis qui échoue si cela concerne un echec, car j'essayrai de mon coté de reproduire l'erreur afin de bien verifier son existence.

### Soumettre une Pull Request

Voici les lignes directrices pour soumettre une Pull Request :

1. Réaliser un Fork du repositorie ToDoList sur votre compte GitHub, puis clonez le repository.

2. Faites vos changements dans une nouvelle branche git :

   ```bash
   git checkout -b fixBug
   ```

3. Créez vots corrections/ajouts, réaliser des test et suivez nos [règles de codage](#règle-de-codage).

4. Poussez votre branche vers GitHub :

   ```bash
   git push origin fixBug
   ```

### Après l'acceptation de votre Pull Request

Vous pouvez supprimer votre branche :

* Supprimez la branche distante sur GitHub :

   ```bash
   git push origin --delete feature/My-Issue
   ```

* Basculer sur la branche master :

   ```bash
   git checkout master
   ```

* Supprimer la branche locale :

   ```bash
   git branch -D feature/My-Issue
   ```

* Mettez à jour votre branch master avec la dernière version :

   ```bash
   git pull --ff upstream master
   ```

## Règle de Codage

Pour assurer la cohérence du code source, gardez ces règles à l'esprit lorsque vous travaillez :

* S'assurer que toutes les fonctionnalités ou corrections de bogues doivent être testées par un ou plusieurs tests (tests unitaires et/ou fonctionnels).
* S'assurer que les ajouts effectués sont optimisés du mieux possible pour ne pas impacter trop négativement les performances de l'application, verfiier donc avant et apres ajout les performances d'execution de vos requetes.
* S'assurer que vos messages de commits soient clair et structurés, précisez d'abord le type de commit, exemple : Correction d"un bug / ajout fonctionnalitée, ensuite écrire une description précise de l'ajout effectuée
* S'assurer que vous ne rajoutez pas de deprecated liées à Symfony