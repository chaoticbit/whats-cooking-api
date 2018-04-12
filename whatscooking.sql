-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 11, 2018 at 05:21 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whatscooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`description`, `timestamp`, `type`, `ref`, `uid`) VALUES
('Wrote a new recipe \"Macaroni pasta\"', '2018-03-14 23:45:19', 3, 9, 3),
('Wrote a new recipe \"Puneri Misal Pav\"', '2018-03-18 00:00:56', 3, 13, 5),
('Upvoted Macaroni pasta', '2018-03-19 16:37:57', 0, 7, 5),
('Upvoted Puneri misal pav', '2018-03-23 14:56:55', 0, 9, 3),
('Wrote a new recipe \"Masala Omelette\"', '2018-03-26 19:44:14', 3, 17, 3),
('Wrote a new recipe \"Chicken tikka masala\"', '2018-03-26 19:54:40', 3, 18, 5),
('Wrote a new recipe \"Chicken potstickers\"', '2018-03-26 23:59:49', 3, 19, 5),
('Wrote a new recipe \"Traditional Hummus\"', '2018-04-03 23:15:01', 3, 20, 3),
('Wrote a new recipe \"Fluffy Pancakes\"', '2018-04-03 23:33:42', 3, 24, 3),
('Wrote a new recipe \"Paneer Chilli Dry\"', '2018-04-03 23:58:32', 3, 25, 3),
('Wrote a new recipe \"Egg roll\"', '2018-04-04 13:38:55', 3, 26, 5),
('Wrote a new recipe \"Eggless Red Velvet Cake\"', '2018-04-05 00:31:12', 3, 27, 3),
('Upvoted Paneer Chilli Dry', '2018-04-08 01:59:12', 0, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cuisines`
--

CREATE TABLE `cuisines` (
  `srno` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `imagepath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisines`
--

INSERT INTO `cuisines` (`srno`, `name`, `imagepath`) VALUES
(1, 'African', 'cuisine_african.jpg'),
(2, 'American', 'cuisine_american.jpg'),
(3, 'Argentine', 'cuisine_argentine.jpg'),
(4, 'Australian', 'cuisine_australian.jpg'),
(5, 'Bakery', 'cuisine_bakery.jpg'),
(6, 'Bangladeshi', 'cuisine_bangladeshi.jpg'),
(7, 'Barbecue', 'cuisine_barbecue.jpg'),
(8, 'Belgian', 'cuisine_belgian.jpg'),
(9, 'Bistro', 'cuisine_bistro.jpg'),
(10, 'Brazilian', 'cuisine_brazilian.jpg'),
(11, 'British', 'cuisine_british.jpg'),
(12, 'Burmese', 'cuisine_burmese.jpg'),
(13, 'Cambodian', 'cuisine_cambodian.jpg'),
(14, 'Caribbean', 'cuisine_caribbean.jpg'),
(15, 'Chinese', 'cuisine_chinese.jpg'),
(16, 'Contemporary', 'cuisine_contemporary.jpg'),
(17, 'Continental', 'cuisine_continental.jpg'),
(18, 'Cuban', 'cuisine_cuban.jpg'),
(19, 'Czech', 'cuisine_czech.jpg'),
(20, 'Dutch', 'cuisine_dutch.jpg'),
(21, 'Desserts', 'cuisine_desserts.jpg'),
(22, 'Egyptian', 'cuisine_egyptian.jpg'),
(23, 'Filipino', 'cuisine_filipino.jpg'),
(24, 'French', 'cuisine_french.jpg'),
(25, 'German', 'cuisine_german.jpg'),
(26, 'Greek', 'cuisine_greek.jpg'),
(27, 'Halal', 'cuisine_halal.jpg'),
(28, 'Hawaiian', 'cuisine_hawaiian.jpg'),
(29, 'Indian', 'cuisine_indian.jpg'),
(30, 'Indonesian', 'cuisine_indonesian.jpg'),
(31, 'Irish', 'cuisine_irish.jpg'),
(32, 'Israeli', 'cuisine_israeli.jpg'),
(33, 'Italian', 'cuisine_italian.jpg'),
(34, 'Jamaican', 'cuisine_jamaican.jpg'),
(35, 'Japanese', 'cuisine_japanese.jpg'),
(36, 'Korean', 'cuisine_korean.jpg'),
(37, 'Latin', 'cuisine_latin.jpg'),
(38, 'Lebanese', 'cuisine_lebanese.jpg'),
(39, 'Malaysian', 'cuisine_malaysian.jpg'),
(40, 'Mediterranean', 'cuisine_mediterranean.jpg'),
(41, 'Mexican', 'cuisine_mexican.jpg'),
(42, 'Middle Eastern', 'cuisine_middle eastern.jpg'),
(43, 'Nepalese', 'cuisine_nepalese.jpg'),
(44, 'Norwegian', 'cuisine_norwegian.jpg'),
(45, 'Pakistani', 'cuisine_pakistani.jpg'),
(46, 'Persian', 'cuisine_persian.jpg'),
(47, 'Polish', 'cuisine_polish.jpg'),
(48, 'Portuguese', 'cuisine_portuguese.jpg'),
(49, 'Puerto Rican', 'cuisine_puerto rican.jpg'),
(50, 'Russian', 'cuisine_russian.jpg'),
(51, 'Scandinavian', 'cuisine_scandinavian.jpg'),
(52, 'Spanish', 'cuisine_spanish.jpg'),
(53, 'Tapas', 'cuisine_tapas.jpg'),
(54, 'Thai', 'cuisine_thai.jpg'),
(55, 'Tibetan', 'cuisine_tibetan.jpg'),
(56, 'Turkish', 'cuisine_turkish.jpg'),
(57, 'Ukrainian', 'cuisine_ukrainian.jpg'),
(58, 'Venezuelan', 'cuisine_venezuelan.jpg'),
(59, 'Vietnamese', 'cuisine_vietnamese.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cuisine_user`
--

CREATE TABLE `cuisine_user` (
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cuisine_user`
--

INSERT INTO `cuisine_user` (`cid`, `uid`) VALUES
(2, 5),
(26, 5),
(41, 5),
(11, 3),
(54, 3),
(39, 3),
(33, 5),
(29, 5),
(2, 3),
(33, 3),
(29, 3),
(15, 3),
(15, 5),
(42, 3),
(42, 5),
(2, 6),
(5, 6),
(11, 6),
(15, 6),
(29, 6),
(54, 6),
(45, 6),
(41, 6),
(40, 6),
(42, 6),
(38, 6),
(33, 6),
(2, 7),
(33, 7),
(5, 7),
(6, 7),
(41, 7),
(42, 7),
(40, 7),
(15, 7),
(45, 7),
(21, 7),
(54, 7),
(29, 7),
(30, 7);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`rid`, `uid`) VALUES
(9, 3),
(13, 3),
(25, 6),
(27, 7);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `srno` int(11) NOT NULL,
  `path` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`srno`, `path`, `type`, `rid`) VALUES
(13, '2953351521071100.jpg', 1, 9),
(14, '7419551521071100.png', 1, 9),
(27, '7920301521330897.mp4', 2, 13),
(28, '6582911521330911.jpg', 1, 13),
(29, '3784831521330911.jpg', 1, 13),
(30, '5425471521330911.jpg', 1, 13),
(31, '1532481522093111.jpg', 1, 17),
(32, '1010011522093123.jpg', 1, 17),
(33, '8892051522093130.jpg', 1, 17),
(34, '4468131522094071.jpg', 1, 18),
(35, '1159001522094071.jpg', 1, 18),
(36, '5581911522108732.jpg', 1, 19),
(37, '2048091522108732.jpg', 1, 19),
(38, '4679371522108732.jpg', 1, 19),
(39, '7627381522796579.jpeg', 1, 20),
(40, '5219201522796579.jpeg', 1, 20),
(41, '6161911522796579.jpeg', 1, 20),
(51, '120071522798316.jpeg', 1, 24),
(52, '4465591522798316.jpeg', 1, 24),
(53, '2192871522798316.jpeg', 1, 24),
(54, '4123071522799816.jpeg', 1, 25),
(55, '2854321522799816.jpeg', 1, 25),
(56, '2813761522799816.jpeg', 1, 25),
(57, '945541522799856.jpeg', 1, 25),
(58, '3222121522799856.jpeg', 1, 25),
(59, '8752191522849125.mp4', 2, 26),
(60, '1346921522849130.jpg', 1, 26),
(61, '2195601522887303.jpg', 1, 27);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`name`) VALUES
('all purpose flour'),
('baking powder'),
('baking soda'),
('black pepper'),
('boneless chicken breasts'),
('butter'),
('buttermilk'),
('capsicum'),
('cayene pepper'),
('chicken'),
('chickpeas'),
('chilli'),
('chilli powder'),
('cocoa powder'),
('confectioners suger'),
('corn flour'),
('cream cheese'),
('cucumber'),
('cumin powder'),
('dry spices'),
('egg'),
('eggs'),
('flour'),
('fresh paneer'),
('garam masala'),
('garlic'),
('ginger'),
('ginger garlic paste'),
('green chilli sauce'),
('green chillis'),
('ground cumin'),
('kosher salt'),
('lemon'),
('lemon juice'),
('macaroni'),
('milk'),
('olive oil'),
('onion'),
('paprika'),
('parsley'),
('red chilli sauce'),
('red food color'),
('red onion'),
('rotis'),
('salt'),
('salt to taste'),
('scallions'),
('sesame oil'),
('sour cream'),
('soy sauce'),
('spring onion'),
('sprouts'),
('sugar'),
('tahini paste'),
('tamarind chutney'),
('tomato'),
('tomato ketchup'),
('turmeric powder'),
('unsalted butter'),
('vanilla extract'),
('vegetable oil'),
('vinegar'),
('white sugar'),
('white vinegar'),
('wonton wrappers'),
('yogurt');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `description` text NOT NULL,
  `type` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `readeflag` int(11) DEFAULT '0',
  `sent` int(11) DEFAULT '0',
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`description`, `type`, `ref`, `timestamp`, `readeflag`, `sent`, `uid`) VALUES
('Atharva Dandekar upvoted your recipe', 3, 7, '2018-03-19 16:37:57', 0, 0, 3),
('Nikita Gokhale upvoted your recipe', 3, 9, '2018-03-23 14:56:55', 0, 0, 5),
('trishala kadam upvoted your recipe', 3, 10, '2018-04-08 01:59:12', 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `srno` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`srno`, `rating`, `rid`) VALUES
(1, 3, 9),
(5, 4, 13),
(9, 0, 17),
(10, 0, 18),
(11, 0, 19),
(12, 0, 20),
(16, 0, 24),
(17, 0, 25),
(18, 0, 26),
(19, 0, 27);

-- --------------------------------------------------------

--
-- Table structure for table `ratings_per_user`
--

CREATE TABLE `ratings_per_user` (
  `rating_id` int(11) NOT NULL,
  `rating` float(4,2) DEFAULT '0.00',
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ratings_per_user`
--

INSERT INTO `ratings_per_user` (`rating_id`, `rating`, `uid`) VALUES
(5, 4.00, 3),
(1, 3.00, 5);

--
-- Triggers `ratings_per_user`
--
DELIMITER $$
CREATE TRIGGER `ac_iRating` AFTER INSERT ON `ratings_per_user` FOR EACH ROW begin
set @rating_id=new.rating_id;
set @recipe_id=(SELECT DISTINCT ratings.rid from ratings, ratings_per_user where ratings.srno=ratings_per_user.rating_id and ratings_per_user.rating_id=@rating_id);
set @rating_avg=(SELECT avg(ratings_per_user.rating) as val from ratings, ratings_per_user where ratings.srno=@rating_id and ratings.srno=ratings_per_user.rating_id);
UPDATE ratings set rating=@rating_avg where srno=@rating_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ac_uRating` AFTER UPDATE ON `ratings_per_user` FOR EACH ROW begin
set @rating_id=new.rating_id;
set @recipe_id=(SELECT DISTINCT ratings.rid from ratings, ratings_per_user where ratings.srno=ratings_per_user.rating_id and ratings_per_user.rating_id=@rating_id);
set @rating_avg=(SELECT avg(ratings_per_user.rating) as val from ratings, ratings_per_user where ratings.srno=@rating_id and ratings.srno=ratings_per_user.rating_id);
UPDATE ratings set rating=@rating_avg where srno=@rating_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `srno` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `ingredients_html` text NOT NULL,
  `preparation` text NOT NULL,
  `ingredients` text NOT NULL,
  `description` text NOT NULL,
  `cover_imagepath` text NOT NULL,
  `edit` int(11) NOT NULL DEFAULT '0',
  `prep_time` varchar(20) NOT NULL,
  `cooking_time` varchar(20) NOT NULL,
  `servings` int(11) NOT NULL,
  `calorie_intake` int(11) NOT NULL,
  `spicy` int(11) NOT NULL DEFAULT '0',
  `food_group` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`srno`, `title`, `ingredients_html`, `preparation`, `ingredients`, `description`, `cover_imagepath`, `edit`, `prep_time`, `cooking_time`, `servings`, `calorie_intake`, `spicy`, `food_group`, `cid`, `uid`, `timestamp`) VALUES
(9, 'Macaroni pasta', '<ol><li>4 pieces Garlic chopped</li><li>2 cups butter </li><li>1 cup milk </li><li>2 cups macaroni </li></ol>', '<ol><li>boil macaroni till its soft.</li><li><span style=\"word-spacing: normal;\">in pan heat olive oil and saute garlic pieces</span></li><li><span style=\"word-spacing: normal;\"> </span><span style=\"word-spacing: normal;\">add butter flour and mix till its paste</span></li><li><span style=\"word-spacing: normal;\">add milk and mix well.</span></li><li><span style=\"word-spacing: normal;\">add macaroni and garnish with herbs.</span><br></li></ol>', 'garlic,butter,milk,macaroni', 'Cheesy Italian pasta.', '2953351521071100.jpg', 0, '10 mins', '15 mins', 2, 350, 2, 100, 33, 3, '2018-03-14 23:45:19'),
(13, 'Puneri misal pav', '<ol><li>2 tbps Ginger garlic paste </li><li>1 cup sprouts </li><li>1 tsp tamarind chutney </li><li>1 cup Dry spices </li><li>1 Onion </li><li>1 Tomato </li></ol>', '<ol><li>Boil sprouts and cook for 5-10 mins.<br></li><li>In a pan take oil and add dry spices.</li><li>Add onion and tomato chopped.</li><li>Add ginger garlic paste and saute for few mins.</li><li>Add boiled sprouts and put cover and let it cook for 5-10 mins.</li><li>Serve with chopped onions and coriander.</li></ol>', 'ginger garlic paste,sprouts,tamarind chutney,dry spices,onion,tomato', 'Authentic maharashtrian dish', '6582911521330911.jpg', 0, '10 mins', '30 mins', 2, 300, 4, 100, 29, 5, '2018-03-18 00:00:56'),
(17, 'Masala Omelette', '<ol><li>2 pieces eggs </li><li>1 medium onion chopped</li><li>1/2 piece tomato finely chopped</li><li>1 clove garlic finely chopped</li><li>1 1/2 tsp chilli powder </li><li>1/2 tsp turmeric powder </li><li>1/4 tsp garam masala </li><li>1tbsp vegetable oil </li><li>1/2 tsp salt or to taste</li><li>1/2 tsp black pepper ground</li><li>1 piece chilli finely chopped</li></ol>', '<ol><li>Break 2 eggs&nbsp;in a bowl and whisk them.</li><li>&nbsp;Add onion, tomato, salt, black pepper, turmeric powder, chilli&nbsp;powder, garam masala, chilli and garlic to the whisked eggs.<br></li><li>Give the mixture a good whisk again.</li><li>In a pan, add the oil and heat the pan on medium flame.</li><li>Add the mixture to the hot pan and rotate the pan so that the mixture spreads around giving you the desired thickness.</li><li>After a few minutes flip the omelette and cook the second side.&nbsp;</li><li>take it off the pan.</li><li>serve it with Bread/Buns and tomato ketchup(optional)</li></ol>', 'eggs,onion,tomato,garlic,chilli powder,turmeric powder,garam masala,vegetable oil,salt,black pepper,chilli', 'Quick and easy Breakfast omelette', '8892051522093130.jpg', 0, '10 mins', '10 mins', 1, 140, 3, 10, 29, 3, '2018-03-26 19:44:14'),
(18, 'Chicken tikka masala', '<ol><li>1 cup yogurt </li><li>1 tbps lemon juice </li><li>2 tsp ground cumin </li><li>2 tsp cayene pepper </li><li>1 tbps ginger minced</li><li>3 boneless chicken breasts </li><li>1 tbps butter </li><li>1 tbps ginger garlic paste </li><li>1 tbps salt to taste </li></ol>', '<ol><li>In a large bowl, combine yogurt, lemon juice, 2 teaspoons cumin, cinnamon, cayenne, black pepper, ginger, and salt. Stir in chicken, cover, and refrigerate for 1 hour.<br></li><li>Preheat a grill for high heat.<br></li><li>Lightly oil the grill grate. Thread chicken onto skewers, and discard marinade. Grill until juices run clear, about 5 minutes on each side.<br></li><li>Melt butter in a large heavy skillet over medium heat. Saute garlic and jalapeno for 1 minute. Season with 2 teaspoons cumin, paprika, and 3 teaspoons salt. Stir in tomato sauce and cream. Simmer on low heat until sauce thickens, about 20 minutes. Add grilled chicken, and simmer for 10 minutes. Transfer to a serving platter, and garnish with fresh cilantro.<br></li></ol>', 'yogurt,lemon juice,ground cumin,cayene pepper,ginger,boneless chicken breasts,butter,ginger garlic paste,salt to taste', 'chicken marinated in yogurt and spices and then served with rice or warm pita bread', '1159001522094071.jpg', 0, '30 mins', '50 mins', 4, 404, 4, 10, 29, 5, '2018-03-26 19:54:40'),
(19, 'Chicken potstickers', '<ol><li>1 pound chicken </li><li>1/3 cup scallions sliced</li><li>2 tsp garlic minced</li><li>1tbsp ginger </li><li>1 tbsp soy sauce </li><li>1 tsp sesame oil </li><li>40 round wonton wrappers </li></ol>', '<p><b>MAKE THE DIPPING SAUCE:</b></p><p>In a medium bowl, whisk together the soy sauce, water, rice wine vinegar, sesame oil, sugar and crushed red pepper flakes (optional). Set the sauce aside.</p><p><b>MAKE THE POTSTICKERS:</b></p><ol><li>In a medium bowl, stir together the ground chicken, scallions, garlic, ginger, soy sauce and sesame oil until well combined.<br></li><li>To assemble the potstickers, arrange the wonton wrappers on a work surface and fill a small bowl with water. Spoon about 2 teaspoons of the chicken mixture into the center of each wrapper.<br></li><li>Dip your finger in the water then run it around the edges of each wonton wrapper. Fold the wrappers in half, pressing the edges together to seal them.<br></li><li>Place a large sauté pan over medium heat then coat the pan with vegetable oil. Once the oil is shimmering, add a single layer of potstickers to the pan and cook them for 1 minute or until they are golden then flip them and cook them an additional 1 to 2 minutes until the filling is cooked throughout.<br></li><li>Transfer the potstickers to a serving plate then repeat the cooking process with the remaining potstickers.<br></li><li>Serve the potstickers immediately with the prepared dipping sauce.<br></li></ol>', 'chicken,scallions,garlic,ginger,soy sauce,sesame oil,wonton wrappers', 'These crispy dumplings feature a mix of ground chicken, garlic, ginger and scallions all tucked inside a wonton wrapper.', '2048091522108732.jpg', 0, '10 mins', '25 mins', 2, 250, 3, 10, 15, 5, '2018-03-26 23:59:49'),
(20, 'Traditional Hummus', '<ol><li>2 cups Chickpeas well cooked/canned, liquid reserved</li><li>1/2 cup tahini paste keep some of its oil intact</li><li>1/4 cup+ 2 tbsp olive oil </li><li>2 cloves garlic you can add more too</li><li>1 1/2 tsp salt or to taste as required</li><li>1 tsp black pepper ground</li><li>1 tbsp paprika or to taste</li><li>1/2 tsp cumin powder optional</li><li>1 piece lemon juiced</li><li>1 tbsp parsley freshly chopped</li></ol>', '<ol><li>Put everything except the parsley in a food processor and begin to process; add the chickpea liquid or water as needed to allow the machine to produce a smooth puree.<br></li></ol><p>2. Taste and adjust the seasoning (I often find I like to add much more lemon juice). Serve, drizzled with the olive oil and sprinkled with a bit more cumin or paprika and some parsley.</p>', 'chickpeas,tahini paste,olive oil,garlic,salt,black pepper,paprika,cumin powder,lemon,parsley', 'An easy Middle Eastern dip best for Vegans too!', '6161911522796579.jpeg', 0, '10 mins', '5 mins', 8, 150, 2, 101, 42, 3, '2018-04-03 23:15:01'),
(24, 'Fluffy Pancakes', '<ol><li>1 1/2 cups all purpose flour </li><li>2 tsp baking powder </li><li>1/2 tsp baking soda </li><li>1 tbsp sugar granulated</li><li>1 1/2 cups buttermilk can also mix milk and white vinegar</li><li>1 egg large</li><li>2 tbsp unsalted butter melted</li></ol>', '<ol><li>In a large bowl, whisk together the flour, baking powder, baking soda, sugar and<span style=\"word-spacing: normal;\"> salt.</span><br></li><li>In a separate medium bowl, whisk together the buttermilk, egg and melted butter. Stir the wet ingredients into the dry ingredients just until combined. (There should be lumps in the batter.)<br></li><li>Place a nonstick pan or griddle over medium-low heat. Grease it with oil. Drop dollops of the batter onto the hot pan. Once bubbles form, flip the pancakes once and continue cooking 1 to 2 more minutes until the pancakes are cooked throughout. Serve immediately with maple syrup or other toppings.<br></li></ol><p><span style=\"word-spacing: normal;\"><br><b>NOTES:</b></span><br></p><p>Do not overmix the batter or the pancakes will be dense and flat rather than light and fluffy.<br><span style=\"word-spacing: normal;\">For an alternative to vegetable oil (and if bacon is on the menu), try cooking the pancakes in bacon grease. The flavor and texture is hard to beat.</span></p>', 'all purpose flour,baking powder,baking soda,sugar,buttermilk,egg,unsalted butter', 'Fluffy and Easy American breakfast', '2192871522798316.jpeg', 0, '10 mins', '5 mins', 4, 200, 1, 10, 2, 3, '2018-04-03 23:33:42'),
(25, 'Paneer Chilli Dry', '<ol><li>200 grams Fresh paneer cubed</li><li>1 large Onion cubed</li><li>1 large Capsicum cubed</li><li>6 cloves Garlic finely chopped</li><li>2 cm Ginger finely chopped</li><li>3 pieces Green chillis slit vertically</li><li>2 tsp Salt Or to taste</li><li>1 tsp Sugar </li><li>2 tbsp Tomato Ketchup </li><li>1 tbsp Red Chilli Sauce or to taste</li><li>1 tbsp Green Chilli Sauce or to taste</li><li>2 tsp Soy Sauce </li><li>1 tsp Vinegar </li><li>1 tbsp Chilli powder </li><li>6 sticks Spring Onion finely chopped</li><li>3 tbsp All purpose Flour </li><li>6 tbsp Corn flour </li></ol>', '<ol><li>Heat 4 tblspn of oil in a pan. Take all the ingredients given for frying in a bowl, add in water and make it to slightly thin batter. Dip the paneer in the batter and fry till golden. Remove it to a plate.<br></li><li>Mix all the sauces in a bowl and set aside.<br></li><li>Now in the remaining oil(if there is no oil, add a tsp more oil). Add in ginger, garlic and chillies. Saute for a min.<br></li><li>Add in onions, capsicum and saute for couple more mins.<br></li><li>Add in salt, sugar and mix well. Add in chilli powder and sauces and mix well. Cook for couple of mins.<br></li><li>Add in the fried paneer and toss.<br></li><li>Add in spring onion and mix well.Serve with noodles or fried rice.<br></li></ol>', 'fresh paneer,onion,capsicum,garlic,ginger,green chillis,salt,sugar,tomato ketchup,red chilli sauce,green chilli sauce,soy sauce,vinegar,chilli powder,spring onion,all purpose flour,corn flour', 'Tasty and spicy Indo-Chinese Dish', '3222121522799856.jpeg', 0, '10 mins', '25 mins', 4, 310, 4, 100, 29, 3, '2018-04-03 23:58:32'),
(26, 'Egg roll', '<ol><li>4 rotis </li><li>2 eggs </li><li>2 tbsp vegetable oil </li><li>1/2 cucumber </li><li>1 red onion </li><li>4 green chillis </li><li> tomato ketchup to taste</li></ol>', '<ol><li>Beat eggs. Add a little milk or salt if desired. Have all salad ingredients thinly sliced and ready.<br></li><li>Heat 1/4 of the oil in a flat large frypan.<br></li><li>Pour 1/4 of the egg mix in and swirl it around to make an omlette the size of the roti. Before the egg sets, place a roti on top and press down gently.<br></li><li>When egg is cooked, flip roti and cook for a couple of seconds.<br></li><li>Remove from the frying pan and place on a board, egg side up.<br></li><li>Arrange 1/4 of the sliced cucumber and onion and 1 sliced chilli (and chicken if using) in a line up the centre of the roti. Squeeze on a little tomato sauce.</li><li>Roll up with the salad ingredients in the middle.</li><li>Wrap with a piece of lunch paper/greaseproof paper to hold it all together,.</li><li>Repeat for the rest of the egg, roti, and salad ingredients.</li></ol><p>Enjoy!</p>', 'rotis,eggs,vegetable oil,cucumber,red onion,green chillis,tomato ketchup', 'One of the famous Kolkata street food dish.', '1346921522849130.jpg', 0, '3 mins', '10 mins', 4, 166, 3, 10, 29, 5, '2018-04-04 13:38:55'),
(27, 'Eggless Red Velvet Cake', '<ol><li>2 1/2 cups Flour Self-rising</li><li>1 tsp Baking soda </li><li>2 tbsp Cocoa powder unsweetened</li><li>1/4 tsp Kosher Salt </li><li>1 cup unsalted butter softened</li><li>1 1/4 cup White Sugar </li><li>1 1/4 cup Sour Cream </li><li>2 tsp Vanilla Extract </li><li>1 1/2 cup buttermilk </li><li>1 tsp White Vinegar </li><li>1 tbsp Red Food Color </li><li>10 oz Cream cheese softened</li><li>1/2 cup unsalted butter softened for frosting</li><li>1 tsp Vanilla extract for frosting</li><li>3 cups Confectioners Suger </li></ol>', '<ol><li>Preheat oven to 350ºF. Butter 2 8 or 9inch round cake pans and dust with cocoa powder.<br></li><li>Sift flour, baking soda, cocoa powder and whisk to combine in a bowl.<br></li><li>In the bowl of your stand mixer fitted with paddle attachment mix beat together butter and sugar until smooth on medium speed. Once smooth add sour cream, vanilla extract, buttermilk, vinegar and red food color; mix till well combined.<br></li><li>Add the dry ingredients and mix until just combined.<br></li><li>Divide batter between cake pans. Bake for 25 - 30 minutes on the same shelf, or until a toothpick inserted into the center comes out clean.<br></li><li>Let it rest for 10 minutes in the pan then turn out onto a cooling rack and allow to cool.<br></li><li>To assemble the cake, remove 1 cake from its pan and place flat side down on a serving platter or cake stand. Spread evenly about 1 cup of icing onto cake and, using a flat spatula. Remove the second cake from its pan. Place flat side down on top of the first layer. Use remaining frosting to cover top and sides of the cake, if desired.</li></ol><b style=\"word-spacing: normal;\">For the Frosting:</b><br><ol><li>Beat in a large bowl with an electric mixer the softened cream cheese and butter on medium speed for 3 - 4 minutes, scraping bowl occasionally, until smooth and creamy.<br></li><li>Stir in vanilla, then stir in confectioners ‘sugar. Add more confectioners ‘sugar as needed until frosting is a thick spreadable consistency.<br></li></ol>', 'flour,baking soda,cocoa powder,kosher salt,unsalted butter,white sugar,sour cream,vanilla extract,buttermilk,white vinegar,red food color,cream cheese,unsalted butter,vanilla extract,confectioners suger', 'Delicious eggless cake', '2195601522887303.jpg', 0, '20 mins', '30 mins', 12, 536, 1, 100, 5, 3, '2018-04-05 00:31:12');

--
-- Triggers `recipes`
--
DELIMITER $$
CREATE TRIGGER `ac_dRecipe` AFTER DELETE ON `recipes` FOR EACH ROW begin 
set @rid=old.srno; 
set @uid=old.uid;
delete from activitylog where ref=@rid and uid=@uid and type=3; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ac_iRecipe` AFTER INSERT ON `recipes` FOR EACH ROW begin
set @rid = new.srno;
set @title = new.title;
set @uid = new.uid;
set @desc = concat('Wrote a new recipe "', @title, '"');
insert into activitylog(description, type, ref, uid) values(@desc, 3, @rid, @uid);
insert into ratings(rid) values(@rid);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `recipe_tags`
--

CREATE TABLE `recipe_tags` (
  `name` varchar(30) DEFAULT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recipe_tags`
--

INSERT INTO `recipe_tags` (`name`, `rid`) VALUES
('cooking', 9),
('italianpasta', 9),
('cooking', 13),
('misalpav', 13),
('eggs', 9),
('indian', 9),
('masalaomelette', 9),
('chickentikka', 13),
('indian', 13),
('cooking', 13),
('dumpling', 19),
('chinese', 19),
('pancakes', 24),
('breakfast', 24),
('american', 24),
('paneer', 25),
('indochinese', 25),
('spicy', 25),
('eggroll', 26),
('indian', 26),
('cooking', 26),
('baking', 27),
('redvelvetcake', 27),
('sweet', 27);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `srno` int(11) NOT NULL,
  `description` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`srno`, `description`, `timestamp`, `rid`, `uid`) VALUES
(2, 'Amazing misal recipe.', '2018-03-23 17:46:18', 13, 3),
(3, 'Wow..was looking for a quick pasta recipe. Found it!', '2018-03-23 18:05:39', 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`name`) VALUES
('american'),
('baking'),
('breakfast'),
('chickentikka'),
('chinese'),
('cooking'),
('dumpling'),
('eggroll'),
('eggs'),
('indian'),
('indochinese'),
('italianpasta'),
('masalaomelette'),
('misalpav'),
('pancakes'),
('paneer'),
('redvelvetcake'),
('spicy'),
('sweet');

-- --------------------------------------------------------

--
-- Table structure for table `upvotes`
--

CREATE TABLE `upvotes` (
  `srno` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `upvotes`
--

INSERT INTO `upvotes` (`srno`, `rid`, `uid`) VALUES
(7, 9, 5),
(9, 13, 3),
(10, 25, 6);

--
-- Triggers `upvotes`
--
DELIMITER $$
CREATE TRIGGER `ac_dUpvote` AFTER DELETE ON `upvotes` FOR EACH ROW begin 
set @srno = old.srno;
set @userid = old.uid;
set @recipe_id = old.rid;
set @recipe_owner=(select uid from recipes where srno=@recipe_id);
delete from notifications where ref=@srno and type=3 and uid=@recipe_owner;
delete from activitylog where ref=@srno and uid=@userid and type=0; 
set @last_ts=(select timestamp from recipes where srno=@recipe_id);
update weightage set weight=weight-0.05, timestamp=@last_ts where rid=@recipe_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ac_iUpvote` AFTER INSERT ON `upvotes` FOR EACH ROW begin 
set @srno=new.srno;
set @name=(select CONCAT(fname,' ', lname) as fullname from useraccounts where srno=new.uid);
set @recipe_owner=(select uid from recipes where srno=new.rid);
if @recipe_owner != new.uid then
insert into notifications(description, type, ref, uid) values(concat(@name, ' upvoted your recipe'), 3, @srno, @recipe_owner);
end if;
set @userid = new.uid; 
set @recipe_id = new.rid; 
set @title = (select title from recipes where srno=@recipe_id); 
set @desc = concat('Upvoted ', @title); 
insert into activitylog(description, type, ref, uid) values(@desc, 0, @srno, @userid);
set @ts=now();
update weightage set weight=weight+0.05, timestamp=@ts where rid=@recipe_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `srno` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`srno`, `username`, `password`, `email`, `fname`, `lname`, `timestamp`) VALUES
(3, 'nikigokhale', '351d6b94f691f791b3f9367e5a84d0a1', 'nikitagokhale20@gmail.com', 'Nikita', 'Gokhale', '2018-03-08 19:32:20'),
(5, 'sipps7', '2dd948da0b7fc3df9ee4cb7d09b582e7', 'dandekar.atharva@gmail.com', 'Atharva', 'Dandekar', '2018-03-17 22:53:34'),
(6, 'trisha', '1bfe5ba665421885e0bf16c6104c795d', 'kadamtrishala@gmail.com', 'trishala', 'kadam', '2018-04-08 01:54:49'),
(7, 'boom_shankar', '2dd948da0b7fc3df9ee4cb7d09b582e7', 'shankarboom@gmail.com', 'Boom', 'Shankar', '2018-04-09 13:40:29');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `country` varchar(30) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `profile_imagepath` text,
  `pref_cuisine` int(11) NOT NULL,
  `food_group` int(11) NOT NULL DEFAULT '0',
  `spiciness` int(11) NOT NULL DEFAULT '1',
  `calorie_intake` int(11) DEFAULT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`city`, `state`, `country`, `gender`, `profile_imagepath`, `pref_cuisine`, `food_group`, `spiciness`, `calorie_intake`, `uid`) VALUES
('Jersey City', 'NJ', 'United States', 'female', 'userdata/3/80001521952001.jpg', 29, 111, 4, 500, 3),
('Jersey City', 'New Jersey', 'United States', 'male', 'userdata/5/3589251522769990.jpeg', 29, 110, 3, 500, 5),
('Jersey City', 'New Jersey', 'United States', 'female', '', 0, 111, 4, 500, 6),
('Pune', 'Maharashtra', 'India', 'male', 'userdata/7/2604461523282969.jpg', 29, 111, 4, 500, 7);

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`rid`, `uid`) VALUES
(9, 3),
(9, 5),
(13, 3),
(13, 6),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(24, 5),
(25, 3),
(25, 6),
(26, 5),
(27, 3),
(27, 5),
(27, 7);

-- --------------------------------------------------------

--
-- Table structure for table `weightage`
--

CREATE TABLE `weightage` (
  `rid` int(11) NOT NULL,
  `weight` float NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weightage`
--

INSERT INTO `weightage` (`rid`, `weight`, `timestamp`) VALUES
(9, 0.05, '2018-03-19 16:37:57'),
(13, 0.05, '2018-03-23 14:56:55'),
(19, 0, '2018-03-26 23:59:49'),
(20, 0, '2018-04-03 23:15:01'),
(21, 0, '2018-04-03 23:32:28'),
(22, 0, '2018-04-03 23:32:33'),
(23, 0, '2018-04-03 23:33:03'),
(24, 0, '2018-04-03 23:33:42'),
(25, 0.05, '2018-04-08 01:59:12'),
(26, 0, '2018-04-04 13:38:55'),
(27, 0, '2018-04-05 00:31:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD KEY `fk_uid_al` (`uid`);

--
-- Indexes for table `cuisines`
--
ALTER TABLE `cuisines`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `cuisine_user`
--
ALTER TABLE `cuisine_user`
  ADD KEY `fk_cid` (`cid`),
  ADD KEY `fk_uid_cu` (`uid`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD KEY `fk_rid_rl` (`rid`),
  ADD KEY `fk_uid_rl` (`uid`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `fk_rid` (`rid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD KEY `fk_uid_up` (`uid`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `fk_rid_rt` (`rid`);

--
-- Indexes for table `ratings_per_user`
--
ALTER TABLE `ratings_per_user`
  ADD KEY `fk_rating_id` (`rating_id`),
  ADD KEY `fk_uid_rtid` (`uid`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `fk_uid` (`uid`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `ingredients` (`ingredients`);
ALTER TABLE `recipes` ADD FULLTEXT KEY `title` (`title`);

--
-- Indexes for table `recipe_tags`
--
ALTER TABLE `recipe_tags`
  ADD KEY `fk_rid_t` (`rid`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `fk_rid_reply` (`rid`),
  ADD KEY `fk_uid_reply` (`uid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `upvotes`
--
ALTER TABLE `upvotes`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `fk_rid_u` (`rid`),
  ADD KEY `fk_uid_u` (`uid`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD KEY `fk_uid_p` (`uid`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`rid`,`uid`),
  ADD KEY `fk_rid_v` (`rid`),
  ADD KEY `fk_uid_v` (`uid`);

--
-- Indexes for table `weightage`
--
ALTER TABLE `weightage`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cuisines`
--
ALTER TABLE `cuisines`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `upvotes`
--
ALTER TABLE `upvotes`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `srno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD CONSTRAINT `fk_uid_al` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `cuisine_user`
--
ALTER TABLE `cuisine_user`
  ADD CONSTRAINT `fk_cid` FOREIGN KEY (`cid`) REFERENCES `cuisines` (`srno`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_uid_cu` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`) ON DELETE CASCADE;

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `fk_rid_rl` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`),
  ADD CONSTRAINT `fk_uid_rl` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fk_rid` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_uid_n` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`),
  ADD CONSTRAINT `fk_uid_up` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `fk_rid_rt` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`);

--
-- Constraints for table `ratings_per_user`
--
ALTER TABLE `ratings_per_user`
  ADD CONSTRAINT `fk_rating_id` FOREIGN KEY (`rating_id`) REFERENCES `ratings` (`srno`),
  ADD CONSTRAINT `fk_uid_rtid` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_uid` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`) ON DELETE CASCADE;

--
-- Constraints for table `recipe_tags`
--
ALTER TABLE `recipe_tags`
  ADD CONSTRAINT `fk_rid_t` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`) ON DELETE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `fk_rid_reply` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_uid_reply` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `upvotes`
--
ALTER TABLE `upvotes`
  ADD CONSTRAINT `fk_rid_u` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`),
  ADD CONSTRAINT `fk_uid_u` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `fk_uid_p` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);

--
-- Constraints for table `views`
--
ALTER TABLE `views`
  ADD CONSTRAINT `fk_rid_v` FOREIGN KEY (`rid`) REFERENCES `recipes` (`srno`),
  ADD CONSTRAINT `fk_uid_v` FOREIGN KEY (`uid`) REFERENCES `useraccounts` (`srno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
