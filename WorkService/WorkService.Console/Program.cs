﻿using System;

namespace WorkService.Console
{
    class Program
    {
        static void Main(string[] args)
        {
            System.Console.WriteLine("Hello World!");
            Worker.WorkQueue.Do WQ = new Worker.WorkQueue.Do();

            WQ.Work();
        }
    }
}
