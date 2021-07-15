# Fibonacci calculator

## Getting started
After creating the interface, I started to think how can I implement the method to get best result.
I have created the class and implemented the interface. Also, I have created the index.php file to check out is the class working fine or not.

The method is working fine, but the code is not clean, and it needs refactor. Also, I didn't write any unit tests yet.

## Other methods
I was looking for the best way to calculate Fibonacci number and implemented 3 methods as below:
1. **Using a for loop (the way I implemented before):** The complexity is O(n) and the performance is well, but the
   method cannot calculate decimal inputs (However, the interface given in the test accepts integer numbers
   only) and also it cannot calculate Fibonacci of negative inputs and I have to tweak the algorithm a little.
1. **Using recursive function:** It seemed a fast and easy-to-understand way at first, but when I did
   a profiling on all methods, I found out that this method takes ~0ms to complete when `$n < 5`, but the taken
   time became more and more and on `$n = 40`, it took more than 20 seconds. By the way, as same as the first
   method, it couldn't calculate the Fibonacci for negative and decimal inputs.
1. **Using the Fibonacci formula:** The formula is `$Fibonacci = pow((1 + sqrt(5), $n) - pow((1 - sqrt(5)), $n)) / (pow(2, $n) * sqrt(5))`.
   This method was the best method among all three (The complexity is O(1) and it can calculate negative and decimal numbers as well),
   but when `$n > 605`, it returns *INF*. The problem can be solved by using PHP's *bcmath* functions.

After doing profiling, I found out that the recursive method is completely useless, because each time the method calls itself twice
until it reaches to $n = 1, so that's why the method takes a long time to complete at larger numbers, and between the methods 1 and 3,
I chose method 1, because I saw that the profiling result of these two methods are almost same as each other, and I have to cast
all values to string to be able to use bcmath functions, so I decided to move on with the old method I was written at first. But I
should mention that if we had to handle decimal values as well, I **had to** use the formula way.

*The other implemented methods are still available (but not used) on Fibonacci.class.php as **getNumberByFormula** and **getNumberByRecursive**.*

So, I made some changes to my method to handle negative inputs as well.

## Unit tests
Now I wanted to write Unit tests, so I initialized composer inside the project and added tests. I provided all happy paths into a single
data provider and put the unhappy paths into separated methods (inputs which result in INF).

I also added an infinity check to throw OutOfRangeException on infinite result.

## Refactor and cleanup

After verifying that everything works, I started to clean up the working directory.