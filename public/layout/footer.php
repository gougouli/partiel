

        </div>
    </div>
        <!--    ==================== Corps de page ====================-->

        <!--    ==================== Pieds de page ====================-->
    <footer class="p-4 text-center bg-secondary">
        <p class="text-center">Ynov 2020 RPZ</p>
        <?php if(!strpos($_SERVER['REQUEST_URI'], "admin")){ ?><!--   Permet de savoir si le mot "admin" est dans l'url et donc de ne pas afficher la newletter sur les pages admin -->
            <h6>Inscrivez-vous à la NewsLetter</h6>
            <form action="" method="post">
                <input type="email" name="email2" class="w-25 p-2" placeholder="example@example.com">
                <input class="btn btn-success" type="submit" value="S'inscrire">
            </form>

        <?php } ?>

    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>
