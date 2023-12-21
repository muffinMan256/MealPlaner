-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2023 at 12:03 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be20_p2`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `first_name`, `last_name`, `email`, `mobile`, `message`) VALUES
(9, 'Andrei', 'Sassu', 'asdasdsadsad', '06649169392', 'asdsadsadsad'),
(10, 'Andrei', 'Sassu', 'sads@sadas.com', '06649169392', 'asdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `planner`
--

CREATE TABLE `planner` (
  `id_planner` int(11) NOT NULL,
  `fk_user_id` int(11) NOT NULL,
  `fk_recipe_id` int(11) NOT NULL,
  `week_day` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `planner`
--

INSERT INTO `planner` (`id_planner`, `fk_user_id`, `fk_recipe_id`, `week_day`) VALUES
(36, 2, 96, 'Tuesday'),
(37, 2, 99, 'Monday'),
(38, 2, 98, 'Thursday'),
(39, 2, 100, 'Sunday'),
(40, 2, 97, 'Friday'),
(42, 1, 71, 'Monday'),
(43, 1, 71, 'Tuesday'),
(44, 1, 71, 'Wednesday'),
(45, 1, 71, 'Thursday'),
(46, 1, 71, 'Friday'),
(47, 1, 71, 'Saturday'),
(48, 1, 71, 'Sunday'),
(49, 2, 72, 'Friday'),
(50, 2, 72, 'Wednesday'),
(51, 2, 81, 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id_recipe` int(11) NOT NULL,
  `name_recipe` varchar(265) NOT NULL,
  `description` mediumtext NOT NULL,
  `img_recipe` varchar(265) NOT NULL,
  `prepTime` time NOT NULL,
  `calories` int(11) NOT NULL,
  `proofed` tinyint(1) NOT NULL,
  `categories` enum('Vegan','Vegetarian','Meat','Dessert','Breakfast','Lunch','Dinner') NOT NULL,
  `ingredients` mediumtext NOT NULL,
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id_recipe`, `name_recipe`, `description`, `img_recipe`, `prepTime`, `calories`, `proofed`, `categories`, `ingredients`, `fk_user`) VALUES
(71, 'Quinoa Salad Delight', 'A refreshing quinoa salad with cherry tomatoes, cucumber, red onion, avocado, and a lemon dressing.', '658416bcf27d1.jpg', '00:45:00', 300, 0, 'Vegan', '1 cup quinoa, 1 cup cherry tomatoes, 1 cucumber, 1/2 red onion, 1 avocado, 1/4 cup lemon juice, salt and pepper to taste', 2),
(72, 'Spicy Lentil Curry', 'A flavorful and hearty lentil curry with coconut milk, spinach, and a blend of curry spices, served over basmati rice.', '65830f0e3432c.jpg', '00:45:00', 400, 0, 'Vegan', '1 cup dried lentils, 1 can coconut milk, 2 cups spinach, 1 tablespoon curry powder, 1 teaspoon cumin, 1 teaspoon paprika, salt to taste, 2 cups basmati rice', 2),
(73, 'Stuffed Bell Peppers', 'Colorful bell peppers stuffed with a delicious mixture of quinoa, black beans, corn, and spices, baked to perfection.', '658311ff8585f.jpg', '00:35:00', 350, 0, 'Vegan', '4 bell peppers, 1 cup cooked quinoa, 1 can black beans, 1 cup corn kernels, 1 teaspoon cumin, 1 teaspoon paprika, salt and pepper to taste', 2),
(74, 'Creamy Avocado Pasta', 'Whole-grain spaghetti tossed in a creamy avocado sauce with garlic, lemon, and a drizzle of olive oil.', '6583171f0d7ee.jpg', '00:20:00', 450, 0, 'Vegan', '8 oz whole-grain spaghetti, 2 ripe avocados, 2 cloves garlic, 1 lemon, 2 tablespoons olive oil, salt and pepper to taste', 2),
(75, 'Chickpea and Vegetable Stir-Fry', 'A quick and easy stir-fry with chickpeas, colorful vegetables, and a savory soy-ginger sauce.', '658317322ddd9.jpg', '00:25:00', 320, 0, 'Vegan', '1 can chickpeas, 2 cups mixed vegetables (broccoli, bell peppers, snap peas), 2 tablespoons soy sauce, 1 tablespoon ginger, 2 cloves garlic, 1 tablespoon sesame oil', 2),
(76, 'Mushroom Risotto', 'Creamy risotto with mushrooms, shallots, and Parmesan cheese, a classic and comforting dish.', '6583173f1d7e3.jpg', '00:40:00', 450, 0, 'Vegetarian', '1 cup Arborio rice, 1 cup sliced mushrooms, 1 shallot, 1/2 cup Parmesan cheese, 4 cups vegetable broth, 1/2 cup dry white wine, salt and pepper to taste', 2),
(77, 'Caprese Salad', 'A simple and elegant Caprese salad with ripe tomatoes, fresh mozzarella, basil, and a drizzle of balsamic glaze.', '6583174ed1747.jpg', '00:15:00', 250, 0, 'Vegetarian', '4 large tomatoes, 8 oz fresh mozzarella, 1 bunch fresh basil, 2 tablespoons balsamic glaze, salt and pepper to taste', 2),
(78, 'Vegetarian Tacos', 'Delicious tacos filled with seasoned black beans, sautéed vegetables, and topped with salsa and guacamole.', '658317708f780.jpg', '00:30:00', 380, 0, 'Vegetarian', '1 can black beans, 1 bell pepper, 1 zucchini, 1 onion, 1 tablespoon taco seasoning, 8 small corn tortillas, salsa, guacamole', 2),
(79, 'Eggplant Parmesan', 'Layers of breaded and baked eggplant slices with marinara sauce and melted mozzarella cheese.', '65831791112e3.jpg', '00:50:00', 420, 0, 'Vegetarian', '2 large eggplants, 1 cup breadcrumbs, 2 cups marinara sauce, 2 cups mozzarella cheese, 1/2 cup grated Parmesan cheese, fresh basil for garnish', 2),
(80, 'Vegetarian Buddha Bowl', 'A nourishing Buddha bowl with quinoa, roasted sweet potatoes, sautéed kale, avocado, and a tahini dressing.', '658317a4784f3.jpg', '00:35:00', 350, 0, 'Vegetarian', '1 cup quinoa, 2 sweet potatoes, 2 cups kale, 1 avocado, 1/4 cup tahini, 2 tablespoons lemon juice, salt and pepper to taste', 2),
(81, 'Grilled Chicken Caesar Salad', 'Juicy grilled chicken breast served over crisp romaine lettuce, tossed in Caesar dressing, and topped with croutons and Parmesan cheese.', '658317b6e8af2.jpg', '00:30:00', 500, 0, 'Meat', '2 boneless, skinless chicken breasts, 1 head romaine lettuce, 1 cup croutons, 1/2 cup grated Parmesan cheese, Caesar dressing', 2),
(82, 'Beef Bolognese Pasta', 'Classic Bolognese sauce with ground beef, tomatoes, onions, and herbs served over your favorite pasta.', '658317c44281d.jpg', '00:45:00', 550, 0, 'Meat', '1 lb ground beef, 1 onion, 2 cloves garlic, 1 can crushed tomatoes, 2 tablespoons tomato paste, 1 teaspoon dried oregano, 1 teaspoon dried basil, salt and pepper to taste', 2),
(83, 'Honey Mustard Glazed Salmon', 'Salmon fillets glazed with a sweet and tangy honey mustard sauce, baked to perfection.', '658317e404636.jpg', '00:25:00', 400, 0, 'Meat', '4 salmon fillets, 1/4 cup Dijon mustard, 2 tablespoons honey, 1 tablespoon soy sauce, 1 tablespoon olive oil, salt and pepper to taste', 2),
(84, 'Pork Carnitas Tacos', 'Slow-cooked and shredded pork carnitas served in warm tortillas with salsa, guacamole, and cilantro.', '658317f6621a1.jpg', '00:50:00', 450, 0, 'Meat', '2 lbs pork shoulder, 1 onion, 3 cloves garlic, 1 tablespoon cumin, 1 tablespoon chili powder, 1 teaspoon oregano, 1 cup salsa, tortillas, guacamole, cilantro', 2),
(85, 'Lemon Herb Roast Chicken', 'Whole roast chicken seasoned with a blend of lemon, garlic, and herbs for a flavorful and tender dish.', '65831802cdbe0.jpg', '00:40:00', 600, 0, 'Meat', '1 whole chicken, 1 lemon, 4 cloves garlic, 2 tablespoons fresh herbs (rosemary, thyme, parsley), 2 tablespoons olive oil, salt and pepper to taste', 2),
(86, 'Chocolate Chip Cookies', 'Classic chocolate chip cookies with a perfect balance of chewiness and chocolatey goodness.', '6583181e4d6da.jpg', '00:55:00', 200, 0, 'Dessert', '1 cup butter, 1 cup brown sugar, 1/2 cup white sugar, 2 eggs, 1 teaspoon vanilla extract, 3 cups all-purpose flour, 1 teaspoon baking soda, 1/2 teaspoon salt, 2 cups chocolate chips', 2),
(87, 'Vanilla Bean Cheesecake', 'Smooth and creamy vanilla bean cheesecake with a buttery graham cracker crust.', '6583183597d91.jpg', '01:00:00', 450, 0, 'Dessert', '2 cups graham cracker crumbs, 1/2 cup butter, 4 packages cream cheese, 1 cup sugar, 1 teaspoon vanilla bean paste, 4 large eggs, 1/2 cup sour cream', 2),
(88, 'Strawberry Shortcake', 'Layers of fluffy shortcake biscuits, fresh strawberries, and whipped cream for a delightful and fruity dessert.', '6583184511216.jpg', '00:45:00', 300, 0, 'Dessert', '2 cups all-purpose flour, 1/4 cup sugar, 1 tablespoon baking powder, 1/2 cup butter, 1 cup heavy cream, 2 cups sliced strawberries, 1 cup whipped cream', 2),
(89, 'Dark Chocolate Mousse', 'Rich and decadent dark chocolate mousse made with quality chocolate and whipped cream.', '65831856511f5.jpg', '00:45:00', 350, 0, 'Dessert', '8 oz dark chocolate, 1/4 cup sugar, 1 teaspoon vanilla extract, 2 cups heavy cream, 4 egg yolks, pinch of salt', 2),
(90, 'Apple Pie', 'Classic apple pie with a flaky crust, sweet apple filling, and a hint of cinnamon and nutmeg.', '658318670a5be.jpg', '01:00:00', 400, 0, 'Dessert', '2 1/2 cups all-purpose flour, 1 cup unsalted butter, 1/4 cup granulated sugar, 1/2 cup ice water, 6 cups peeled and sliced apples, 3/4 cup sugar, 1 teaspoon cinnamon, 1/4 teaspoon nutmeg', 2),
(91, 'Avocado Toast with Poached Egg', 'Sliced avocado on whole-grain toast topped with a perfectly poached egg and a sprinkle of salt and pepper.', '6583187663f75.jpg', '00:20:00', 300, 0, 'Breakfast', '2 slices whole-grain bread, 1 ripe avocado, 2 eggs, salt and pepper to taste', 2),
(92, 'Greek Yogurt Parfait', 'Layered Greek yogurt with granola, fresh berries, and a drizzle of honey for a healthy and delicious breakfast.', '65831885260d0.jpg', '00:10:00', 250, 0, 'Breakfast', '1 cup Greek yogurt, 1/2 cup granola, 1 cup mixed berries (strawberries, blueberries, raspberries), 2 tablespoons honey', 2),
(93, 'Vegetarian Omelette', 'Fluffy omelette filled with sautéed vegetables like bell peppers, onions, and tomatoes, and topped with cheese.', '658318934305d.jpg', '00:20:00', 350, 0, 'Breakfast', '3 eggs, 1/4 cup bell peppers, 1/4 cup onions, 1/4 cup tomatoes, 1/2 cup shredded cheese, salt and pepper to taste', 2),
(94, 'Blueberry Pancakes', 'Light and fluffy blueberry pancakes made with buttermilk and bursting with fresh blueberries.', '658318a3ede50.jpg', '00:25:00', 400, 0, 'Breakfast', '1 cup all-purpose flour, 2 tablespoons sugar, 1 teaspoon baking powder, 1/2 teaspoon baking soda, 1 cup buttermilk, 1 egg, 1 cup fresh blueberries', 2),
(95, 'Smashed Avocado and Tomato Bagel', 'Toasted bagel halves topped with smashed avocado, sliced tomatoes, and a sprinkle of everything bagel seasoning.', '658318b8597c2.jpg', '00:15:00', 320, 0, 'Breakfast', '2 bagels, 1 ripe avocado, 1 tomato, everything bagel seasoning, salt and pepper to taste', 2),
(96, 'Chicken Caesar Wrap', 'Grilled chicken, romaine lettuce, and Caesar dressing wrapped in a whole-grain tortilla for a quick and satisfying lunch.', '658318c8c13ea.jpg', '00:20:00', 400, 0, 'Lunch', '1 grilled chicken breast, 1 cup chopped romaine lettuce, 2 tablespoons Caesar dressing, 1 whole-grain tortilla', 2),
(97, 'Mediterranean Quinoa Bowl', 'A nourishing bowl with quinoa, cherry tomatoes, cucumber, olives, feta cheese, and a drizzle of balsamic vinaigrette.', '658318dcb48d8.jpg', '00:20:00', 350, 0, 'Lunch', '1 cup cooked quinoa, 1 cup cherry tomatoes, 1/2 cucumber, 1/4 cup olives, 1/4 cup feta cheese, balsamic vinaigrette', 2),
(98, 'Turkey and Avocado Wrap', 'Sliced turkey, avocado, lettuce, and tomato wrapped in a whole-grain tortilla for a light and flavorful lunch.', '658318ed4da2a.jpg', '00:25:00', 300, 0, 'Lunch', '4 slices turkey, 1/2 avocado, lettuce, tomato, 1 whole-grain tortilla', 2),
(99, 'Vegetable Stir-Fry with Tofu', 'A colorful and tasty stir-fry with tofu, broccoli, bell peppers, and snow peas in a savory soy-ginger sauce.', '65831900e812e.jpg', '00:25:00', 320, 0, 'Lunch', '1 block firm tofu, 2 cups broccoli florets, 1 bell pepper, 1 cup snow peas, 2 tablespoons soy sauce, 1 tablespoon ginger, 2 cloves garlic, 1 tablespoon sesame oil', 2),
(100, 'Caprese Panini', 'A grilled panini with fresh mozzarella, tomato slices, and basil leaves, drizzled with balsamic glaze.', '6583190dcad8c.jpg', '00:20:00', 380, 0, 'Lunch', '4 slices bread, 8 oz fresh mozzarella, 2 tomatoes, fresh basil leaves, balsamic glaze', 2),
(101, 'Grilled Lemon Herb Chicken', 'Juicy grilled chicken marinated in a flavorful blend of lemon, herbs, and garlic. Perfectly grilled for a delicious dinner.', '65831918c6f24.jpg', '00:40:00', 400, 0, 'Dinner', 'Chicken Breasts, Lemon, Rosemary, Thyme, Garlic, Olive Oil', 2),
(102, 'Vegetarian Eggplant Lasagna', 'Layers of thinly sliced eggplant, marinara sauce, and melted cheese create a delicious and hearty vegetarian lasagna.', '65831929b6ab4.jpg', '01:10:00', 350, 0, 'Dinner', 'Eggplant, Marinara Sauce, Ricotta Cheese, Mozzarella Cheese, Parmesan Cheese', 2),
(103, 'Salmon with Lemon-Dill Sauce', 'Baked salmon fillets topped with a refreshing lemon-dill sauce. A light and elegant dinner option.', '658319387cd43.jpg', '00:25:00', 320, 0, 'Dinner', 'Salmon Fillets, Lemon, Dill, Olive Oil, Garlic', 2),
(104, 'Mushroom Risotto', 'Creamy and savory mushroom risotto made with Arborio rice, mushrooms, and a rich vegetable broth.', '658319485ea8a.jpg', '00:35:00', 380, 0, 'Dinner', 'Arborio Rice, Mushrooms, Onion, Vegetable Broth, Parmesan Cheese', 2),
(105, 'Grilled Veggie Skewers', 'Colorful vegetable skewers marinated and grilled to perfection. A delightful and healthy dinner option.', '65831959288ff.jpg', '00:45:00', 250, 0, 'Dinner', 'Bell Peppers, Zucchini, Cherry Tomatoes, Red Onion, Balsamic Marinade', 2),
(106, 'Demo4', 'Demo4', 'default.png', '00:00:44', 44, 0, 'Dessert', 'Demo4', 31),
(107, 'demo', 'this is our recipes', 'default.png', '00:00:12', 12, 0, 'Vegan', 'this are the ingredients', 2),
(108, 'demotest', 'sadasd', '658417fd73adb.jpg', '00:00:12', 12, 0, 'Dessert', 'asdasdasd', 2),
(109, 'demotest', 'testdemo', 'default.png', '00:33:33', 333, 0, 'Lunch', 'demo333', 2);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `user_name` varchar(200) NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text NOT NULL,
  `datetime` int(11) NOT NULL,
  `fk_userid` int(11) NOT NULL,
  `fk_recipeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `user_name`, `user_rating`, `user_review`, `datetime`, `fk_userid`, `fk_recipeid`) VALUES
(22, 'TestUser', 5, 'One of the Best Chickpea and Vegetable Stir-Fry i ate!', 1703073073, 1, 75),
(23, 'testUser', 4, 'Super !!', 1703073812, 2, 71),
(28, 'testUser2', 1, 'War leider nicht so gut!', 1703075497, 2, 71),
(30, 'Demo4', 3, 'The recipe was ok!', 1703077364, 31, 71),
(31, 'Demo4', 5, 'Was very good!', 1703077386, 31, 78);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `status` varchar(30) NOT NULL,
  `img_user` varchar(255) NOT NULL,
  `blocked` tinyint(1) NOT NULL,
  `new_user` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `first_name`, `last_name`, `email`, `password`, `status`, `img_user`, `blocked`, `new_user`) VALUES
(1, 'Admin', 'admin', 'testadmin@test.at', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 'adm', 'default_user.png', 0, 1),
(2, 'FirstUser', 'LastUser', 'testuser@test.at', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'default_user.png', 0, 0),
(28, 'demo1', 'demo1', 'demo1@demo1.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'default_user.png', 0, 0),
(29, 'demo2', 'demo2', 'demo2@demo2.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'default_user.png', 0, 0),
(30, 'demo3', 'demo3', 'demo3@demo3.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'default_user.png', 0, 0),
(31, 'demo4', 'demo4', 'demo4@demo4.com', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'user', 'default_user.png', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planner`
--
ALTER TABLE `planner`
  ADD PRIMARY KEY (`id_planner`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_recipe_id` (`fk_recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id_recipe`),
  ADD KEY `fk_user` (`fk_user`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_userid` (`fk_userid`),
  ADD KEY `fk_recipeid` (`fk_recipeid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `planner`
--
ALTER TABLE `planner`
  MODIFY `id_planner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id_recipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `planner`
--
ALTER TABLE `planner`
  ADD CONSTRAINT `planner_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `planner_ibfk_2` FOREIGN KEY (`fk_recipe_id`) REFERENCES `recipes` (`id_recipe`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `review_table`
--
ALTER TABLE `review_table`
  ADD CONSTRAINT `review_table_ibfk_1` FOREIGN KEY (`fk_userid`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `review_table_ibfk_2` FOREIGN KEY (`fk_recipeid`) REFERENCES `recipes` (`id_recipe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
