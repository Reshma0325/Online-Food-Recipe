-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2024 at 11:31 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foods`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `Admin_Id` int(11) NOT NULL,
  `Admin_Name` varchar(50) NOT NULL,
  `Admin_Mail` varchar(255) NOT NULL,
  `Admin_Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`Admin_Id`, `Admin_Name`, `Admin_Mail`, `Admin_Password`) VALUES
(4, 'Reshma', 'reshma@gmail.com', 'reshma');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertisements`
--

CREATE TABLE `tbl_advertisements` (
  `Ad_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Ad_Title` varchar(255) DEFAULT NULL,
  `Ad_Description` text DEFAULT NULL,
  `Ad_Image` varchar(255) DEFAULT NULL,
  `No_Of_Days` int(11) DEFAULT NULL,
  `Start_Date` date DEFAULT NULL,
  `End_Date` date DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Placed_On` date DEFAULT curdate(),
  `Ad_Status` varchar(20) DEFAULT NULL,
  `Click_Count` int(11) DEFAULT 0,
  `Views_Count` int(11) DEFAULT 0,
  `Target_Audience` varchar(255) DEFAULT NULL,
  `Ad_Type` varchar(50) DEFAULT NULL,
  `Is_Active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bankaccount`
--

CREATE TABLE `tbl_bankaccount` (
  `Id` int(100) NOT NULL,
  `User_Id` int(100) NOT NULL,
  `Account_Number` bigint(100) NOT NULL,
  `Bank_Name` varchar(100) NOT NULL,
  `IFSC` bigint(100) NOT NULL,
  `Account_Name` varchar(100) NOT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bankaccount`
--

INSERT INTO `tbl_bankaccount` (`Id`, `User_Id`, `Account_Number`, `Bank_Name`, `IFSC`, `Account_Name`, `date`) VALUES
(3, 11, 897896789, 'Canara', 568988908, 'Reshma', '2024-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `Category_Id` int(11) NOT NULL,
  `Category_Name` varchar(255) NOT NULL,
  `Category_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`Category_Id`, `Category_Name`, `Category_Image`) VALUES
(1, 'Main Courses', 'images/category/maincourses.png'),
(2, 'Desserts', 'images/category/desserts.png'),
(3, 'Salads', 'images/category/salads.png'),
(4, 'Snacks', 'images/category/snacks.png'),
(5, 'Breakfast', 'images/category/breakfast.png'),
(6, 'Curries', 'images/category/curries.png'),
(11, 'Lunch', 'images/category/lunch.png'),
(12, 'Diet', 'images/category/healthy.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `User_Name` varchar(255) NOT NULL,
  `User_Mail` varchar(255) NOT NULL,
  `User_Mobile` varchar(20) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Placed_On` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`Id`, `User_Id`, `User_Name`, `User_Mail`, `User_Mobile`, `Message`, `Placed_On`) VALUES
(7, 10, 'priya', 'priya@gmail.com', '8989897898', 'Thanks', '2023-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nutritions`
--

CREATE TABLE `tbl_nutritions` (
  `Nutrition_Id` int(11) NOT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Kcal` varchar(20) NOT NULL,
  `Fat` varchar(20) NOT NULL,
  `Saturates` varchar(20) NOT NULL,
  `Carbs` varchar(20) NOT NULL,
  `Sugars` varchar(20) NOT NULL,
  `Fibre` varchar(20) NOT NULL,
  `Protein` varchar(20) NOT NULL,
  `Salt` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nutritions`
--

INSERT INTO `tbl_nutritions` (`Nutrition_Id`, `Recipe_Id`, `Kcal`, `Fat`, `Saturates`, `Carbs`, `Sugars`, `Fibre`, `Protein`, `Salt`) VALUES
(14, 4, '567', '40g', '13g', '4g', '1g', '0g', '49g', '0.84g'),
(15, 5, '715', '45g', '14g', '49g', '4g', '3g', '27g', '2.6g'),
(16, 6, '432', '23g', '4g', '24g', '  4g', '3g', '30g', '1.7g'),
(18, 8, '469', '29g', '17g', '50g', '29g', '1g', '6g', '0.93g'),
(19, 9, '452', '14g', '4g', '43g', '26g', '12g', '33g', '0.5g'),
(20, 10, '0', '0g', '0g', '0g', '0g', '0g', '0g', '0g'),
(21, 11, '387', '25g', '18g', '32g', '15g', '7g', '6g', '0.6g'),
(22, 12, '387', '18g', '3g', '12g', '10g', '3g', '37g', '0.6g'),
(23, 13, '458', '28g', '16g', '31g', '9g', '10g', '15g', '0.2g'),
(24, 14, '452', '11g', '4g', '52g', '23g', '13g', '29g', '0.8g'),
(25, 15, '0', '0g', '0g', '0g', '0g', '0g', '0g', '0g'),
(26, 16, '420', '19g', '10g', '49g', '5g', '6g', '11g', '0.3g'),
(27, 17, '356', '13g', '6g', '46g', '8g', '2g', '13g', '1.3g'),
(28, 18, '371', '28g', '9g', '5g', '0g', '1g', '24g', '2g'),
(29, 19, '260', '13g', '3g', '3g', '1g', '3g', '32g', '0.9g');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `Payment_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Amount` int(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Placed_On` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`Payment_Id`, `User_Id`, `Recipe_Id`, `Amount`, `Status`, `Placed_On`) VALUES
(4, 11, 4, 100, '₹ 100  is credited', '2024-01-04'),
(5, 11, 5, 100, 'pending', '2024-01-04'),
(6, 11, 6, 100, 'pending', '2024-01-05'),
(8, 13, 8, 100, '', '2024-01-05'),
(9, 13, 9, 100, 'pending', '2024-01-05'),
(10, 14, 10, 100, '', '2024-01-08'),
(11, 14, 11, 100, '', '2024-01-11'),
(12, 15, 12, 100, '', '2024-01-11'),
(13, 15, 13, 100, '', '2024-01-11'),
(15, 15, 14, 100, '', '2024-01-11'),
(16, 15, 15, 100, '', '2024-01-11'),
(17, 14, 16, 100, '', '2024-01-23'),
(18, 14, 17, 100, '', '2024-01-23'),
(19, 14, 18, 100, '', '2024-01-23'),
(20, 13, 19, 100, '₹ 100  is credited', '2024-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `Rating_Id` int(11) NOT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `User_Name` varchar(255) NOT NULL,
  `Rating_Value` decimal(3,1) DEFAULT NULL,
  `Comments` text DEFAULT NULL,
  `Placed_On` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ratings`
--

INSERT INTO `tbl_ratings` (`Rating_Id`, `Recipe_Id`, `User_Id`, `User_Name`, `Rating_Value`, `Comments`, `Placed_On`) VALUES
(19, 5, 10, 'priya', '4.0', 'Wow Recipe', '2024-03-10 10:17:09'),
(20, 9, 10, 'priya', '5.0', 'Nice', '2024-03-12 14:17:41'),
(21, 5, 16, 'Remya', '5.0', 'Nice', '2024-03-18 14:17:17'),
(22, 6, 16, 'Remya', '4.0', 'nice', '2024-03-18 14:37:10'),
(23, 4, 16, 'Remya', '4.0', 'nice recipe', '2024-03-18 14:43:21'),
(24, 6, 10, 'priya', '5.0', 'dsb', '2024-03-18 15:14:11');

--
-- Triggers `tbl_ratings`
--
DELIMITER $$
CREATE TRIGGER `update_ratings` AFTER INSERT ON `tbl_ratings` FOR EACH ROW BEGIN
    -- Update total ratings and average rating
    UPDATE tbl_Recipes
    SET Total_Ratings = (
        SELECT SUM(Rating_Value)
        FROM tbl_Ratings
        WHERE Recipe_Id = NEW.Recipe_Id
    ),
    Average_Rating = (
        SELECT AVG(Rating_Value)
        FROM tbl_Ratings
        WHERE Recipe_Id = NEW.Recipe_Id
    )
    WHERE Recipe_Id = NEW.Recipe_Id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recipeimages`
--

CREATE TABLE `tbl_recipeimages` (
  `Image_Id` int(11) NOT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Image_Url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_recipeimages`
--

INSERT INTO `tbl_recipeimages` (`Image_Id`, `Recipe_Id`, `Image_Url`) VALUES
(14, 4, 'images/recipeimages/Classic roast chicken & gravy.png'),
(15, 5, 'images/recipeimages/Potted crab.png'),
(16, 6, 'images/recipeimages/Salmon egg-fried rice.png'),
(18, 8, 'images/recipeimages/Blueberry cake with cream cheese frosting.png'),
(19, 9, 'images/recipeimages/Steaks with goulash sauce & sweet potato fries.png'),
(20, 10, 'images/recipeimages/Scandi cheese & crackers.png'),
(21, 11, 'images/recipeimages/Sweet potato & peanut curry.png'),
(22, 12, 'images/recipeimages/Easy butter chicken.png'),
(23, 13, 'images/recipeimages/Chickpea curry.png'),
(24, 14, 'images/recipeimages/Spicy pies with sweet potato mash.png'),
(25, 15, 'images/recipeimages/Green salad with avocado.png'),
(26, 16, 'images/recipeimages/Pesto pasta salad.png'),
(27, 17, 'images/recipeimages/American pancakes.png'),
(28, 18, 'images/recipeimages/Greek salad omelette.png'),
(29, 19, 'images/recipeimages/Chicken and mushrooms.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recipeingredients`
--

CREATE TABLE `tbl_recipeingredients` (
  `Ingredient_Id` int(11) NOT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Ingredient_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_recipeingredients`
--

INSERT INTO `tbl_recipeingredients` (`Ingredient_Id`, `Recipe_Id`, `Ingredient_Name`) VALUES
(73, 4, '1 onion, roughly chopped'),
(74, 4, '2 carrots, roughly chopped'),
(75, 4, '1 free range chicken, about 1.5kg/3lb 5oz'),
(76, 4, '1 lemon, halved'),
(77, 4, 'small bunch thyme (optional)'),
(78, 4, '25g butter, softened'),
(79, 4, '1 tbsp plain flour'),
(80, 4, '250ml chicken stock (a cube is fine)'),
(81, 5, '150g picked white crabmeat, the freshest you can buy'),
(82, 5, '2 tbsp mayonnaise'),
(83, 5, '1 shallot, peeled and finely chopped'),
(84, 5, 'small handful chives, chopped'),
(85, 5, '½ orange, zested'),
(86, 5, '2 large slices sourdough, grilled or griddled, to serve'),
(87, 5, '60g butter'),
(88, 5, '¼ tsp smoked paprika'),
(89, 6, 'thumb-sized piece ginger, grated'),
(90, 6, '1-2 garlic cloves, grated'),
(91, 6, '2 tbsp low-salt soy sauce'),
(92, 6, '½ tbsp rice wine or sherry vinegar'),
(93, 6, '2 tbsp vegetable oil'),
(94, 6, '1 large carrot, chopped into chunks'),
(95, 6, '175g pack baby corn & mangetout or sugar snap peas, chopped'),
(96, 6, '2 skinless salmon fillets'),
(97, 6, '250g pouch cooked brown basmati rice'),
(98, 6, '2 eggs'),
(99, 6, 'hot sauce, to serve'),
(110, 8, '175g soft butter'),
(111, 8, '175g golden caster sugar'),
(112, 8, '3 large eggs'),
(113, 8, '225g self-raising flour'),
(114, 8, '1 tsp baking powder'),
(115, 8, '2 tsp vanilla extract'),
(116, 8, '142ml carton soured cream'),
(117, 8, '3 x punnets blueberry'),
(118, 8, '200g full-fat cream cheese'),
(119, 8, '100g icing sugar'),
(120, 9, '3 tsp rapeseed oil, plus extra for the steaks'),
(121, 9, '250g sweet potatoes, peeled and cut into narrow chips'),
(122, 9, '1 tbsp fresh thyme leaves'),
(123, 9, '2 small onions, halved and sliced (190g)'),
(124, 9, '1 green pepper, deseeded and diced'),
(125, 9, '2 garlic cloves, sliced'),
(126, 9, '1 tsp smoked paprika'),
(127, 9, '85g cherry tomatoes, halved'),
(128, 9, '1 tbsp tomato purée'),
(129, 9, '1 tsp vegetable bouillon powder'),
(130, 9, '2 x 125g fillet steaks, rubbed with a little rapeseed oil'),
(131, 9, '200g bag baby spinach, wilted in a pan or the microwave'),
(132, 10, 'low-fat soft cheese'),
(133, 10, 'snipped chives'),
(134, 10, 'a few cornichons'),
(135, 10, 'wholewheat biscuits or crackers'),
(136, 11, '1 tbsp coconut oil'),
(137, 11, '1 onion, chopped'),
(138, 11, '2 garlic cloves, grated'),
(139, 11, 'thumb-sized piece ginger, grated'),
(140, 11, '3 tbsp Thai red curry paste (check the label to make sure it’s vegetarian/ vegan)'),
(141, 11, '1 tbsp smooth peanut butter'),
(142, 11, '500g sweet potato, peeled and cut into chunks'),
(143, 11, '400ml can coconut milk'),
(144, 11, '200g bag spinach'),
(145, 11, '1 lime, juiced'),
(146, 11, 'cooked rice, to serve (optional)'),
(147, 11, 'cooked rice, to serve (optional)'),
(148, 12, '500g skinless boneless chicken thighs'),
(149, 12, 'For the marinade '),
(150, 12, '1/2-1 lemon, (to taste) juiced'),
(151, 12, '2 tsp ground cumin &  paprika'),
(152, 12, '1-2 tsp hot chilli powder'),
(153, 12, '200g natural yogurt'),
(154, 12, 'For the curry'),
(155, 12, '2 tbsp vegetable oil'),
(156, 12, '1 large onion, chopped'),
(157, 12, '3 garlic cloves, crushed'),
(158, 12, 'thumb-sized piece ginger, grated'),
(159, 12, '3 tbsp tomato purée'),
(160, 12, '300ml chicken stock'),
(161, 13, 'For the paste'),
(162, 13, '2 tbsp oil'),
(163, 13, '1 onion, diced'),
(164, 13, '1 tsp fresh or dried chilli, to taste'),
(165, 13, '9 garlic cloves (approx 1 small bulb of garlic)'),
(166, 13, 'thumb-sized piece ginger, peeled'),
(167, 13, 'For the curry'),
(168, 13, '2 x 400g cans chickpeas, drained'),
(169, 13, '400g can chopped tomatoes'),
(170, 13, '100g creamed coconut'),
(171, 13, '400g can chopped tomatoes'),
(172, 13, '2 x 400g cans chickpeas, drained'),
(173, 13, 'To serve cooked rice and/or dahl'),
(174, 14, 'For the mash'),
(175, 14, '1kg sweet potatoes, peeled and cut into large chunks'),
(176, 14, '2 tbsp milk'),
(177, 14, '50g mature cheddar, finely grated'),
(178, 14, 'For the mince'),
(179, 14, '1 tbsp rapeseed oil'),
(180, 14, '2 onions, halved and sliced'),
(181, 14, '500g lean beef mince (5% fat)'),
(182, 14, '1 tbsp smoked paprika, plus extra for sprinkling'),
(183, 14, '1 tbsp ground cumin'),
(184, 14, '1 tbsp ground coriander'),
(185, 14, '1 tbsp mild chilli powder'),
(186, 14, '1 tbsp vegetable bouillon powder'),
(187, 14, '400g can black-eyed beans'),
(188, 14, '400g can chopped tomatoes'),
(189, 14, '1large green pepper, diced'),
(190, 14, '326g can of sweetcorn in water'),
(191, 14, 'broccoli or salad, to serve (optional)'),
(192, 15, '1 tbsp lemon juice'),
(193, 15, 'pinch of salt'),
(194, 15, '4 tbsp olive oil'),
(195, 15, 'small bunch finely chopped chives'),
(196, 15, '200g bag mixed salad leaves'),
(197, 15, '2 sliced, ripe avocados'),
(198, 16, '400g mini pasta shapes'),
(199, 16, '200ml crème fraîche'),
(200, 16, '4 tbsp fresh pesto'),
(201, 16, '½ cucumber, cut into small cubes'),
(202, 16, '16 cherry tomatoes, cut into quarters, or halved'),
(203, 16, '200g frozen peas, cooked and chilled'),
(204, 16, 'handful basil leaves'),
(205, 17, '200g self-raising flour'),
(206, 17, '1 ½ tsp baking powder'),
(207, 17, '1 tbsp golden caster sugar'),
(208, 17, '3 large eggs'),
(209, 17, '25g melted butter, plus extra for cooking'),
(210, 17, '200ml milk'),
(211, 17, 'vegetable oil, for cooking'),
(212, 17, 'To serve'),
(213, 17, 'maple syrup'),
(214, 17, 'toppings of your choice, such as cooked bacon, chocolate chips, blueberries or peanut butter and jam'),
(215, 18, '10 eggs'),
(216, 18, 'handful of parsley leaves, chopped (optional)'),
(217, 18, '2 tbsp olive oil'),
(218, 18, '1 large red onion, cut into wedges'),
(219, 18, '3 tomatoes, chopped into large chunks'),
(220, 18, 'large handful black olives, (pitted are easier to eat)'),
(221, 18, '100g feta cheese, crumbled'),
(223, 19, '2 tbsp olive oil'),
(224, 19, '500g boneless, skinless chicken thigh'),
(225, 19, 'flour, for dusting'),
(226, 19, '50g cubetti di pancetta'),
(227, 19, '300g small button mushroom'),
(228, 19, '2 large shallots, chopped'),
(229, 19, '250ml chicken stock'),
(230, 19, '1 tbsp white wine vinegar'),
(231, 19, '50g frozen pea'),
(232, 19, 'small handful parsley, finely chopped');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recipes`
--

CREATE TABLE `tbl_recipes` (
  `Recipe_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Recipe_Name` varchar(255) NOT NULL,
  `Servings` varchar(30) DEFAULT NULL,
  `Preparation_Time` varchar(18) DEFAULT NULL,
  `Cooking_Time` varchar(18) DEFAULT NULL,
  `Category_Id` int(11) DEFAULT NULL,
  `Subcategory_Id` int(11) DEFAULT NULL,
  `Recipe_Video` varchar(255) DEFAULT NULL,
  `Placed_On` date DEFAULT curdate(),
  `Total_Ratings` int(11) DEFAULT 0,
  `Average_Rating` decimal(3,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_recipes`
--

INSERT INTO `tbl_recipes` (`Recipe_Id`, `User_Id`, `Recipe_Name`, `Servings`, `Preparation_Time`, `Cooking_Time`, `Category_Id`, `Subcategory_Id`, `Recipe_Video`, `Placed_On`, `Total_Ratings`, `Average_Rating`) VALUES
(4, 11, 'Classic roast chicken & gravy', '4', '10 mins', '1 hr & 30 mins', 6, 6, 'images/recipevideos/pizza.mp4', '2024-01-04', 4, '4.0'),
(5, 11, 'Potted crab', '2', '10 mins', '2 mins', 1, 1, 'images/recipevideos/pizza.mp4', '2024-01-04', 9, '4.5'),
(6, 11, 'Salmon egg-fried rice', '2 - 3', '10 mins', '10 mins', 11, 19, 'images/recipevideos/video.mp4', '2024-01-05', 9, '4.5'),
(8, 13, 'Blueberry cake with cream cheese frosting', 'Cuts into 10 slices', '25 mins - 35 mins', '50 mins', 2, 7, 'images/recipevideos/cake.mp4', '2024-01-05', 0, NULL),
(9, 13, 'Steaks with goulash sauce & sweet potato fries', '2', '10 mins', '25 mins', 4, 16, 'images/recipevideos/potato fries.mp4', '2024-01-05', 5, '5.0'),
(10, 14, 'Scandi cheese & crackers', '1', '10 mins', '5 mins', 4, 16, 'images/recipevideos/Scandi cheese & crackers.mp4', '2024-01-08', 0, NULL),
(11, 14, 'Sweet potato & peanut curry', '4', '15 mins', '45 mins', 1, 2, 'images/recipevideos/sweet potato curry.mp4', '2024-01-11', 0, NULL),
(12, 15, 'Easy butter chicken', '4', '15 mins', '35 mins', 1, 4, 'images/recipevideos/butter chicken.mp4', '2024-01-11', 0, NULL),
(13, 15, 'Chickpea curry', '4', '15 mins', '25 mins', 6, 5, 'images/recipevideos/chickpea curry.mp4', '2024-01-11', 0, NULL),
(14, 15, 'Spicy pies with sweet potato mash', '4', '20 mins', '40 mins', 2, 8, 'images/recipevideos/Spicy pies with sweet potato mash.mp4', '2024-01-11', 0, NULL),
(15, 15, 'Green salad with avocado', '10', '10 mins', '0', 3, 9, 'images/recipevideos/Green salad with avocado.mp4', '2024-01-11', 0, NULL),
(16, 14, '  Pesto pasta salad', '6', '10 mins', '12 mins', 3, 10, 'images/recipevideos/Pesto pasta salad.mp4', '2024-01-23', 0, NULL),
(17, 14, 'American pancakes', '4', '25 mins', '30 mins', 5, 11, 'images/recipevideos/American pancakes.mp4', '2024-01-23', 0, NULL),
(18, 14, 'Greek salad omelette', '4 - 6', '2 mins', '20 mins', 5, 12, 'images/recipevideos/Greek salad omelette.mp4', '2024-01-23', 0, NULL),
(19, 13, 'Chicken and mushrooms', '4', '15 mins', '25 mins', 12, 22, 'images/recipevideos/butter chicken.mp4', '2024-03-11', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recipesteps`
--

CREATE TABLE `tbl_recipesteps` (
  `Step_Id` int(11) NOT NULL,
  `Recipe_Id` int(11) DEFAULT NULL,
  `Step_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_recipesteps`
--

INSERT INTO `tbl_recipesteps` (`Step_Id`, `Recipe_Id`, `Step_Name`) VALUES
(57, 4, 'STEP 1 Heat oven to 190C/fan 170C/gas 5. Have a shelf ready in the middle of the oven without any shelves above it.'),
(58, 4, 'STEP 2 Scatter 1 roughly chopped onion and 2 roughly chopped carrots over the base of a roasting tin that fits the whole 1 ½ kg chicken, but doesn’t swamp it.'),
(59, 4, 'STEP 3 Season the cavity of the chicken liberally with salt and pepper, then stuff with 2 lemon halves and a small bunch of thyme, if using.'),
(60, 4, 'STEP 4 Sit the chicken on the vegetables, smother the breast and legs all over with 25g softened butter, then season the outside with salt and pepper.'),
(61, 4, 'STEP 5 Place in the oven and leave, undisturbed, for 1 hr 20 mins – this will give you a perfectly roasted chicken. To check, pierce the thigh with a skewer and the juices should run clear.'),
(62, 5, 'STEP 1 Tip the crabmeat into a bowl and mix with the mayonnaise, shallot, chives, orange zest and some seasoning. Spoon the mixture into a shallow serving dish. Smooth the top over, then pop in the fridge to chill.'),
(63, 5, 'STEP 2 Gently melt the butter and smoked paprika together. Leave the butter to cool a little, but don’t let it solidify. Carefully pour the clear butter fat over the crab, leaving the milky butter residue still in the saucepan. Return to the fridge for 20'),
(64, 6, 'STEP 1 Mix the ginger, garlic, soy and vinegar, and set aside. Heat a large pan or wok and add 1 tbsp oil, the vegetables and salmon. Fry the salmon for 2 mins each side until it begins to turn opaque. Tip in the rice and stir, flaking the fish into large'),
(65, 6, 'STEP 2 Add the remaining oil to the pan, crack in the eggs and stir to roughly scramble them. Once cooked, stir through the rice and pour over the soy marinade. Season and leave to bubble away for a few mins more, so that all the rice is coated in the sau'),
(68, 8, 'STEP 1 Preheat the oven to fan160C/ conventional 180C/gas 4 and butter and line the base of a loose-based 22cm round cake tin with non-stick baking paper or reusable Bake-o-glide.'),
(69, 8, 'STEP 2 Put the butter, sugar, eggs,flour, baking powder and vanilla in a bowl. Beat with a wooden spoon for 2-3 minutes, or with a hand electric beater for 1-2 minutes, until lighter in colour and well mixed. Beat in 4 tbsp soured cream, then stir in half'),
(70, 8, 'STEP 3 Tip the mixture into the tin and spread it level. Bake for 50 minutes until it is risen, feels firm to the touch and springs back when lightly pressed. Cool for 10 minutes, then take out of the tin and peel off the paper or lining. Leave to finish '),
(71, 9, 'STEP 1 Heat oven to 240C/220C fan/gas 7 and put a wire rack on top of a baking tray. Toss the sweet potatoes and thyme with 2 tsp oil in a bowl, then scatter them over the rack and set aside until ready to cook.'),
(72, 9, 'STEP 2 Heat 1 tsp oil in a non-stick pan, add the onions, cover the pan and leave to cook for 5 mins. Take off the lid and stir – they should be a little charred now. Stir in the green pepper and garlic, cover the pan and cook for 5 mins more. Put the pot'),
(73, 9, 'STEP 3 While the potatoes are cooking, stir the paprika into the onions and peppers, pour in 150ml water and stir in the cherry tomatoes, tomato purée and bouillon. Cover and simmer for 10 mins.'),
(74, 9, 'STEP 4 Pan-fry the steak in a hot, non-stick pan for 2-3 mins each side depending on their thickness. Rest for 5 mins. Spoon the goulash sauce onto plates and top with the beef. Serve the chips and spinach alongside.'),
(75, 10, 'STEP 1 Dollop low-fat soft cheese, snipped chives and a few cornichons into a tub. Eat with wholewheat crackers.'),
(76, 11, 'STEP 1 Melt 1 tbsp coconut oil in a saucepan over a medium heat and soften 1 chopped onion for 5 mins. Add 2 grated garlic cloves and a grated thumb-sized piece of ginger, and cook for 1 min until fragrant.'),
(77, 11, 'STEP 2 Stir in 3 tbsp Thai red curry paste, 1 tbsp smooth peanut butter and 500g sweet potato, peeled and cut into chunks, then add 400ml coconut milk and 200ml water.'),
(78, 11, 'STEP 3 Bring to the boil, turn down the heat and simmer, uncovered, for 25-30 mins or until the sweet potato is soft.'),
(79, 11, 'STEP 4 Stir through 200g spinach and the juice of 1 lime, and season well. Serve with cooked rice, and if you want some crunch, sprinkle over a few dry roasted peanuts.'),
(80, 12, 'STEP 1 In a medium bowl, mix all the marinade ingredients with some seasoning. Chop the chicken into bite-sized pieces and toss with the marinade. Cover and chill in the fridge for 1 hr or overnight.'),
(81, 12, 'STEP 2 In a large, heavy saucepan, heat the oil. Add the onion, garlic, green chilli, ginger and some seasoning. Fry on a medium heat for 10 mins or until soft.'),
(82, 12, 'STEP 3 Add the spices with the tomato purée, cook for a further 2 mins until fragrant, then add the stock and marinated chicken. Cook for 15 mins, then add any remaining marinade left in the bowl. Simmer for 5 mins, then sprinkle with the toasted almonds.'),
(83, 13, 'STEP 1 To make the paste, heat a little of the 2 tbsp oil in a frying pan, add 1 diced onion and 1 tsp fresh or dried chilli, and cook until softened, about 8 mins.'),
(84, 13, 'STEP 2 In a food processor, combine 9 garlic cloves, a thumb-sized piece of peeled ginger and the remaining oil, then add 1 tbsp ground coriander, 2 tbsp ground cumin, 1 tbsp garam masala, 2 tbsp tomato purée, ½ tsp salt and the fried onion. Blend to a sm'),
(85, 13, 'STEP 3 Cook the paste in a medium saucepan for 2 mins over a medium-high heat, stirring occasionally so it doesn’t stick.'),
(86, 13, 'STEP 4 Tip in two 400g cans drained chickpeas and a 400g can chopped tomatoes, and simmer for 5 mins until reduced down.'),
(87, 13, 'STEP 5 Add 100g creamed coconut with a little water, cook for 5 mins more, then add ½ small pack chopped coriander and 100g spinach, and cook until wilted.'),
(88, 13, 'STEP 6 Garnish with extra coriander and serve with rice or dhal (or both).'),
(89, 14, 'STEP 1 Boil the sweet potato for 15 mins or until tender, taking care not to overcook.'),
(90, 14, 'STEP 2 Meanwhile, heat the oil in a large, deep, non-stick frying pan. Add the onions, cover and cook for 8 mins or until softened and starting to colour. Stir in the mince, breaking it up with a wooden spoon until browned. Stir in all the spices and boui'),
(91, 14, 'STEP 3 While the mince cooks, mash the potatoes with the milk to make a stiff mash. Spoon the mince into six individual pie dishes, top each with some mash, then sprinkle over the cheese and a little paprika.'),
(92, 14, 'STEP 4 The pies can now be frozen. If eating straight away, put under a hot grill until piping hot and the cheese is melted. To cook from frozen, thaw completely, then reheat in the oven on a baking tray at 180C/160C fan/ gas 4 for 30-40 mins or until pip'),
(93, 15, 'STEP 1 Squeeze 1 tbsp lemon juice into a jam jar with a pinch of salt. Pour in 4 tbsp olive oil, add a small bunch finely chopped chives, put on the lid, then shake well. To serve, toss with 200g bag mixed salad leaves and 2 sliced ripe avocados.'),
(94, 16, 'STEP 1 Cook the pasta for 10 mins in salted boiling water until al dente, drain, then tip into a bowl. Stir in the crème fraîche followed by the pesto, then leave to cool.'),
(95, 16, 'STEP 2 When the pasta is cool, stir in the cucumber, tomatoes and peas followed by the basil leaves. Season if it needs it, and tip into a container to transport it.'),
(96, 17, 'STEP 1 Mix 200g self-raising flour, 1 ½ tsp baking powder, 1 tbsp golden caster sugar and a pinch of salt together in a large bowl.'),
(97, 17, 'STEP 2 Create a well in the centre with the back of your spoon then add 3 large eggs, 25g melted butter and 200ml milk.'),
(98, 17, 'STEP 3 Whisk together either with a balloon whisk or electric hand beaters until smooth then pour into a jug.'),
(99, 17, 'STEP 4 Heat a small knob of butter and 1 tsp of oil in a large, non-stick frying pan over a medium heat. When the butter looks frothy, pour in rounds of the batter, approximately 8cm wide. Make sure you don’t put the pancakes too close together as they wi'),
(100, 17, 'STEP 5 Cook the pancakes on one side for about 1-2 mins or until lots of tiny bubbles start to appear and pop on the surface. Flip the pancakes over and cook for a further minute on the other side. Repeat until all the batter is used up.'),
(101, 17, 'STEP 6 Serve your pancakes stacked up on a plate with a drizzle of maple syrup and any of your favourite toppings.'),
(102, 18, 'STEP 1 Heat the grill to high. Whisk the eggs in a large bowl with the chopped parsley, pepper and salt, if you want. Heat the oil in a large non-stick frying pan, then fry the onion wedges over a high heat for about 4 mins until they start to brown aroun'),
(103, 18, 'STEP 2 Turn the heat down to medium and pour in the eggs. Cook the eggs in the pan, stirring them as they begin to set, until half cooked, but still runny in places – about 2 mins. Scatter over the feta, then place the pan under the grill for 5-6 mins unt'),
(107, 19, 'STEP 1 Heat 1 tbsp oil in a frying pan. Season and dust the chicken with flour, brown on all sides. Remove. Fry the pancetta and mushrooms until softened, then remove.'),
(108, 19, 'STEP 2 Add the final tbsp oil and cook shallots for 5 mins. Add the stock and vinegar, bubble for 1-2 mins. Return the chicken, pancetta and mushrooms and cook for 15 mins. Add the peas and parsley and cook for 2 mins more, then serve.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saves`
--

CREATE TABLE `tbl_saves` (
  `Save_Id` int(11) NOT NULL,
  `User_Id` int(11) DEFAULT NULL,
  `Recipe_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_saves`
--

INSERT INTO `tbl_saves` (`Save_Id`, `User_Id`, `Recipe_Id`) VALUES
(17, 10, 4),
(18, 10, 8),
(19, 10, 9),
(20, 10, 15),
(21, 16, 5),
(22, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategories`
--

CREATE TABLE `tbl_subcategories` (
  `Subcategory_Id` int(11) NOT NULL,
  `Subcategory_Name` varchar(255) NOT NULL,
  `Category_Id` int(11) DEFAULT NULL,
  `Subcategory_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategories`
--

INSERT INTO `tbl_subcategories` (`Subcategory_Id`, `Subcategory_Name`, `Category_Id`, `Subcategory_Image`) VALUES
(1, 'Seafood', 1, 'images/subcategory/seafood.png'),
(2, 'Vegetarian', 1, 'images/subcategory/veg.png'),
(4, 'Nonveg', 1, 'images/subcategory/nonveg.png'),
(5, 'Veg Curry', 6, 'images/subcategory/vegcurry.png'),
(6, 'Non Veg Curry', 6, 'images/subcategory/nonvegcurry.png'),
(7, 'Cakes', 2, 'images/subcategory/cakes.png'),
(8, 'Pies', 2, 'images/subcategory/pies.png'),
(9, 'Green Salads', 3, 'images/subcategory/greensalad.png'),
(10, 'Pasta Salads', 3, 'images/subcategory/pastasalad.png'),
(11, 'Pan Cakes', 5, 'images/subcategory/pancakes.png'),
(12, 'Omlettes', 5, 'images/subcategory/omlettes.png'),
(13, 'Pastas', 5, 'images/subcategory/pastas.png'),
(14, 'Creamy Soup', 5, 'images/subcategory/creamysoup.png'),
(15, 'Chicken Bites', 4, 'images/subcategory/chickenbites.png'),
(16, 'Crackers', 4, 'images/subcategory/cheesecrackers.png'),
(17, 'Dips', 4, 'images/subcategory/dips.png'),
(18, 'Pizza', 4, 'images/subcategory/pizza.png'),
(19, 'Rice Varieties', 11, 'images/subcategory/ricevarities.png'),
(20, 'Briyani', 11, 'images/subcategory/briyani.png'),
(21, 'rolls', 4, 'images/subcategory/rolls.png'),
(22, 'Low Calories', 12, 'images/subcategory/low calorie.png'),
(23, 'Diabetic', 12, 'images/subcategory/diabetic.png'),
(24, 'Pregnancy', 12, 'images/subcategory/pregnancy.png'),
(25, 'Zero Oil', 12, 'images/subcategory/zero oil.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `User_Id` int(11) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `User_Mail` varchar(255) NOT NULL,
  `User_Mobile` varchar(10) NOT NULL,
  `User_Type` varchar(50) DEFAULT NULL,
  `User_Gender` varchar(25) DEFAULT NULL,
  `User_Date_Of_Birth` date DEFAULT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Joined_On` date DEFAULT curdate(),
  `User_Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`User_Id`, `User_Name`, `User_Mail`, `User_Mobile`, `User_Type`, `User_Gender`, `User_Date_Of_Birth`, `User_Password`, `User_Joined_On`, `User_Image`) VALUES
(10, 'priya', 'priya@gmail.com', '8989897898', 'viewer', 'female', '2001-10-03', 'priya', '2023-12-01', 'userimages/t11.jpg'),
(11, 'Sri', 'sri@gmail.com', '7897896785', 'publisher', 'female', '2001-11-11', 'sri', '2023-12-01', 'userimages/t7.jpg'),
(12, 'Prakash', 'prakash@gmail.com', '2345678998', 'advertiser', 'male', '2003-11-29', 'prakash', '2023-12-01', 'userimages/t10.jpg'),
(13, 'Sowbarnika', 'sowbarnika@gmail.com', '7898678965', 'publisher', 'female', '2002-01-13', 'sowbar', '2024-01-05', 'userimages/t5.jpg'),
(14, 'Jesi', 'jesi@gmail.com', '8899654867', 'publisher', 'female', '2002-07-23', 'jesi', '2024-01-08', 'userimages/t7.jpg'),
(15, 'Janet', 'janet@gmail.com', '8976898789', 'publisher', 'female', '2001-08-07', 'janet', '2024-01-11', 'userimages/t9.jpg'),
(16, 'Remya', 'remya@gmail.com', '8909890789', 'viewer', 'female', '2003-11-13', 'remya', '2024-03-18', 'userimages/t13.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  ADD PRIMARY KEY (`Ad_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_bankaccount`
--
ALTER TABLE `tbl_bankaccount`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `fk` (`User_Id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`Category_Id`);

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tbl_nutritions`
--
ALTER TABLE `tbl_nutritions`
  ADD PRIMARY KEY (`Nutrition_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`Payment_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`Rating_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`),
  ADD KEY `User_Id` (`User_Id`);

--
-- Indexes for table `tbl_recipeimages`
--
ALTER TABLE `tbl_recipeimages`
  ADD PRIMARY KEY (`Image_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_recipeingredients`
--
ALTER TABLE `tbl_recipeingredients`
  ADD PRIMARY KEY (`Ingredient_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_recipes`
--
ALTER TABLE `tbl_recipes`
  ADD PRIMARY KEY (`Recipe_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Category_Id` (`Category_Id`),
  ADD KEY `Subcategory_Id` (`Subcategory_Id`);

--
-- Indexes for table `tbl_recipesteps`
--
ALTER TABLE `tbl_recipesteps`
  ADD PRIMARY KEY (`Step_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_saves`
--
ALTER TABLE `tbl_saves`
  ADD PRIMARY KEY (`Save_Id`),
  ADD KEY `User_Id` (`User_Id`),
  ADD KEY `Recipe_Id` (`Recipe_Id`);

--
-- Indexes for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD PRIMARY KEY (`Subcategory_Id`),
  ADD KEY `Category_Id` (`Category_Id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`User_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `Admin_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  MODIFY `Ad_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_bankaccount`
--
ALTER TABLE `tbl_bankaccount`
  MODIFY `Id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `Category_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_nutritions`
--
ALTER TABLE `tbl_nutritions`
  MODIFY `Nutrition_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `Payment_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `Rating_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_recipeimages`
--
ALTER TABLE `tbl_recipeimages`
  MODIFY `Image_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_recipeingredients`
--
ALTER TABLE `tbl_recipeingredients`
  MODIFY `Ingredient_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `tbl_recipes`
--
ALTER TABLE `tbl_recipes`
  MODIFY `Recipe_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_recipesteps`
--
ALTER TABLE `tbl_recipesteps`
  MODIFY `Step_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_saves`
--
ALTER TABLE `tbl_saves`
  MODIFY `Save_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  MODIFY `Subcategory_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_advertisements`
--
ALTER TABLE `tbl_advertisements`
  ADD CONSTRAINT `tbl_advertisements_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`),
  ADD CONSTRAINT `tbl_advertisements_ibfk_2` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_bankaccount`
--
ALTER TABLE `tbl_bankaccount`
  ADD CONSTRAINT `fk` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`);

--
-- Constraints for table `tbl_nutritions`
--
ALTER TABLE `tbl_nutritions`
  ADD CONSTRAINT `tbl_nutritions_ibfk_1` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD CONSTRAINT `tbl_payments_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`),
  ADD CONSTRAINT `tbl_payments_ibfk_2` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD CONSTRAINT `tbl_ratings_ibfk_1` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`),
  ADD CONSTRAINT `tbl_ratings_ibfk_2` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`);

--
-- Constraints for table `tbl_recipeimages`
--
ALTER TABLE `tbl_recipeimages`
  ADD CONSTRAINT `tbl_recipeimages_ibfk_1` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_recipeingredients`
--
ALTER TABLE `tbl_recipeingredients`
  ADD CONSTRAINT `tbl_recipeingredients_ibfk_1` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_recipes`
--
ALTER TABLE `tbl_recipes`
  ADD CONSTRAINT `tbl_recipes_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`),
  ADD CONSTRAINT `tbl_recipes_ibfk_2` FOREIGN KEY (`Category_Id`) REFERENCES `tbl_categories` (`Category_Id`),
  ADD CONSTRAINT `tbl_recipes_ibfk_3` FOREIGN KEY (`Subcategory_Id`) REFERENCES `tbl_subcategories` (`Subcategory_Id`);

--
-- Constraints for table `tbl_recipesteps`
--
ALTER TABLE `tbl_recipesteps`
  ADD CONSTRAINT `tbl_recipesteps_ibfk_1` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_saves`
--
ALTER TABLE `tbl_saves`
  ADD CONSTRAINT `tbl_saves_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `tbl_users` (`User_Id`),
  ADD CONSTRAINT `tbl_saves_ibfk_2` FOREIGN KEY (`Recipe_Id`) REFERENCES `tbl_recipes` (`Recipe_Id`);

--
-- Constraints for table `tbl_subcategories`
--
ALTER TABLE `tbl_subcategories`
  ADD CONSTRAINT `tbl_subcategories_ibfk_1` FOREIGN KEY (`Category_Id`) REFERENCES `tbl_categories` (`Category_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
