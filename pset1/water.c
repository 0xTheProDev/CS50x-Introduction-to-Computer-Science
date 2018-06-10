#include <cs50.h>  //For Input puspose
#include <stdio.h> //For 'printf' fuction

int main(void)
{
    float wat, bot;
    printf("minutes: ");
    wat = GetInt();
    bot = wat * 1.5 * 8;
    printf("bottles: %.0f\n",bot);
}