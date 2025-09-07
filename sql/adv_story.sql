-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2025 at 10:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adv_story`
--

-- --------------------------------------------------------

--
-- Table structure for table `story_nodes`
--

CREATE TABLE `story_nodes` (
  `id` int(11) NOT NULL,
  `story_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `choice1_text` varchar(255) DEFAULT NULL,
  `choice1_next` int(11) DEFAULT NULL,
  `choice2_text` varchar(255) DEFAULT NULL,
  `choice2_next` int(11) DEFAULT NULL,
  `is_ending` tinyint(1) DEFAULT 0,
  `choice1_image` varchar(255) DEFAULT NULL,
  `choice2_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story_nodes`
--

INSERT INTO `story_nodes` (`id`, `story_id`, `text`, `choice1_text`, `choice1_next`, `choice2_text`, `choice2_next`, `is_ending`, `choice1_image`, `choice2_image`) VALUES
(1, 1, 'You enter a dark haunted house…', 'Go upstairs', 2, 'Explore basement', 3, 0, 'go-upstairs.jpg', 'explore-basement.jpg'),
(2, 1, 'You see a ghost!', 'Run away', 4, 'Talk to ghost', 5, 0, 'run-away.jpg', 'talk-to-ghost.jpg'),
(3, 1, 'The basement is creepy and dark…', 'Light a torch', 6, 'Go back', 2, 0, 'light-torch.jpg', 'go-back.jpg'),
(4, 1, 'You safely exit the house', '', NULL, '', NULL, 1, NULL, NULL),
(5, 1, 'The ghost gives you a treasure', 'Take treasure', 7, 'Leave it', 4, 0, 'take-treasure.jpg', 'leave-treasure.jpg'),
(6, 1, 'Torch lights up secret passage', 'Enter passage', 8, 'Ignore and explore more', 3, 0, 'enter-passage.jpg', 'ignore-explore.jpg'),
(7, 1, 'Treasure is cursed!', 'Keep it', 9, 'Throw it away', 4, 0, 'keep-treasure.jpg', 'throw-away.jpg'),
(8, 1, 'Passage leads to hidden library', 'Read book', 10, 'Go back', 2, 0, 'read-book.jpg', 'go-back-library.jpg'),
(9, 1, 'Curse takes you to ghost world', '', NULL, '', NULL, 1, NULL, NULL),
(10, 1, 'You learn ghost secrets & escape', '', NULL, '', NULL, 1, NULL, NULL),
(11, 2, 'You wake up in a locked room', 'Look for key', 12, 'Try door', 13, 0, 'look-for-key.jpg', 'try-door.jpg'),
(12, 2, 'You find a key under the carpet', 'Open door', 19, 'Keep searching', 17, 0, 'open-door.jpg', 'keep-searching.jpg'),
(13, 2, 'Door is locked, trap triggers!', 'Call for help', 15, 'Panic', 16, 0, 'call-help.jpg', 'panic.jpg'),
(14, 2, 'You escape successfully', '', NULL, '', NULL, 1, NULL, NULL),
(15, 2, 'Help arrives and saves you', '', NULL, '', NULL, 1, NULL, NULL),
(16, 2, 'You get trapped forever', '', NULL, '', NULL, 1, NULL, NULL),
(17, 2, 'You notice a secret note on wall', 'Read it', 18, 'Ignore it and try opening the door.', 13, 0, 'read-note.jpg', 'ignore-note.jpg'),
(18, 2, 'Note reveals hidden button', 'Press it', 14, 'Ignore', 16, 0, 'press-button.jpg', 'ignore-button.jpg'),
(19, 2, 'You find a hidden passage', 'Go through it', 14, 'Stay and keep searching for clues.', 17, 0, 'enter-passage.jpg', 'keep-searching.jpg'),
(20, 3, 'Lune calls you for a date', 'Accept', 21, 'Refuse', 22, 0, 'accept-date.jpg', 'refuse-date.jpg'),
(21, 3, 'You go on a fun date', 'Kiss him', 23, 'Just hang out', 24, 0, 'kiss-him.jpg', 'just-hang-out.jpg'),
(22, 3, 'You refuse, he calls again', 'Accept now', 21, 'Ignore', 25, 0, 'accept-now.jpg', 'ignore.jpg'),
(23, 3, 'You end up together happily', '', NULL, '', NULL, 1, NULL, NULL),
(24, 3, 'Just friends', '', NULL, '', NULL, 1, NULL, NULL),
(25, 3, 'He gets sad, relationship ends', '', NULL, '', NULL, 1, NULL, NULL),
(26, 3, 'He surprises you with flowers', 'Accept', 23, 'Refuse politely', 24, 0, NULL, NULL),
(27, 3, 'You plan another date', 'Outdoor picnic', 23, 'Movie night', 24, 0, NULL, NULL),
(28, 3, 'Misunderstanding arises', 'Talk it out', 23, 'Ignore', 25, 0, NULL, NULL),
(29, 3, 'He sends a cute message', 'Reply', 27, 'Ignore', 25, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'a', 'a7469549582a09c7e0dd5f9bfb9b4ca9', 0),
(2, 'aashika', 'a7469549582a09c7e0dd5f9bfb9b4ca9', 0),
(3, 'neeru', '1a0a052a55457616b27b5b23e915b8d3', 0),
(4, 'sita', 'eed4ce9a4a117c8c5a14bccf046c4850', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `user_id` int(11) DEFAULT NULL,
  `story_id` int(11) DEFAULT NULL,
  `current_node` int(11) DEFAULT NULL,
  `choices_taken` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `story_nodes`
--
ALTER TABLE `story_nodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `story_nodes`
--
ALTER TABLE `story_nodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
